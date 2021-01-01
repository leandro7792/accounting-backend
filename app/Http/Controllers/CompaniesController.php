<?php

namespace App\Http\Controllers;

use App\Activity;
use App\AdministrationType;
use App\Company;
use App\CompanySize;
use App\CompanyType;
use App\Contact;
use App\Folder;
use App\Partner;
use App\Responsible;
use App\Tax;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company
                        ::with('company_type:id,initials')
                        ->orderBy('approved', 'asc')
                        ->orderBy('fancy_name', 'asc')
                        ->get(['id', 'code', 'cnpj', 'fancy_name', 'company_type_id', 'approved']);

        return view('companies.index', compact('companies'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company->load('contacts');
        $company->load('activities');
        $company->activities->load('cnae:id,code,description');
        $company->load('company_type');
        $company->load('company_size');
        $company->load('tax');
        $company->load('administration_type');
        $company->load('partners');

        $users = User::all();

        return view('companies.show', compact('company', 'users'));
    }

    /**
     * Approve a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve(Company $company)
    {
        $company->approved = true;

        $company->save();

        return redirect()->route('companies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company->load('contacts');
        $company->load('activities');
        $company->activities->load('cnae:id,code,description');
        $company->load('company_type');
        $company->load('company_size');
        $company->load('tax');
        $company->load('administration_type');
        $company->load('partners');
        $company->load('responsibles');
        $company->responsibles->load('user');


        $company_types = CompanyType::all();
        $company_sizes = CompanySize::all();
        $taxes = Tax::all();
        $administration_types = AdministrationType::all();
        $token = User::find(1)->api_token;

        $users = User::with('roles')->whereHas('roles')->get(['id', 'name']);

        return view('companies.edit', compact('company', 'company_types', 'company_sizes', 'taxes', 'administration_types', 'token', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'company_type_id' => "required|exists:company_types,id",
            'company_size_id' => "required_if:company_type,in:2,3,4,5|exists:company_sizes,id",
            'tax_id' => "required_if:company_type,in:2,3,4,5,6|exists:taxes,id",
            'administration_type_id' => "required_if:company_type,in:2,3,4,5,6|exists:administration_types,id",
            'code' => "required",
            'cnpj' => "required",
            'corporate_name' => "required",
            'fancy_name' => 'required',
            'share_capital' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'f1' => 'nullable',
            'f2' => 'nullable',
            'f3' => 'nullable',
            'f4' => 'nullable',
            'f5' => 'nullable',
            'comments' => 'nullable',


            'activities' => 'required|array|min:1',
            'activities.*' => 'exists:cnaes,id',

            'contacts' => 'required|array|min:1',
            'contacts.*.id' => 'nullable|numeric|exists:contacts,id',
            'contacts.*.name' => 'required|string|min:3',
            'contacts.*.phone' => 'required|string|min:8',
            'contacts.*.email' => 'required|email',

            'partners' => 'required|array|min:1',
            'partners.*.id' => 'nullable|numeric|exists:partners,id',
            'partners.*.name' => 'required|string|min:3',
            'partners.*.phone' => 'required|string|min:8',
            'partners.*.email' => 'required|email',
            'partners.*.marital_status' => 'required|string|min:3',
            'partners.*.wedding_type' => 'nullable|string|min:3',
            'partners.*.notary_public' => 'required|string|min:3',
            'partners.*.naturalness' => 'required|string|min:3',
            'partners.*.pro_labore' => 'nullable|string',
            'partners.*.registered_federal_revenue' => 'nullable|boolean',

            'responsibles' => 'nullable|array|min:1',
            'responsibles.*.id' => 'nullable|numeric|exists:responsibles,id',
            'responsibles.*.user_id' => 'nullable|numeric|exists:users,id',
        ]);


        // echo json_encode($validatedData);
        // return;

        $retryTimes = 1;
        DB::transaction(function () use (&$validatedData, &$company) {

            $data = $validatedData;

            $activities = collect($data['activities']);
            $contacts = collect($data['contacts']);
            $partners = collect($data['partners']);
            $responsibles =  isset($data['responsibles'])
                                ? collect($data['responsibles'])
                                : collect([]);

            unset($data['activities']);
            unset($data['contacts']);
            unset($data['partners']);

            if(!isset($data['f5'])) {
                $data['f5'] = 0;
            }

            // atualiza dados da empresa
            $company->fill($data);
            $company->save();

            // Remove/cria novas Atividades
            $company->load('activities');
            $company
                ->activities
                ->whereNotIn('cnae_id', $activities)
                ->map(function ($activity) {
                    Activity::destroy($activity->id);
                });

            $activities
                ->diff($company->activities->pluck('cnae_id'))
                ->map(function ($activity) use (&$company) {
                    Activity::create(['cnae_id' => $activity, 'company_id' => $company->id]);
                });
            // fim atividades


            // Remove/cria/atualiza novos Contatos
            $company->load('contacts');
            $company
                ->contacts
                ->whereNotIn('id', $contacts->pluck('id')->filter())
                ->map(function ($contact) {
                    Contact::destroy($contact->id);
                });

            $contacts
                ->map(function ($contact) use (&$company) {
                    if (isset($contact['id'])) {
                        Contact
                            ::where('company_id', $company->id)
                            ->where('id', $contact['id'])
                            ->update($contact);
                    } else {
                        $contact['company_id'] = $company->id;
                        Contact::create($contact);
                    }
                });
            // contato


            // Remove/cria novos Contatos
            $company->load('partners');
            $company
                ->partners
                ->whereNotIn('id', $partners->pluck('id')->filter())
                ->map(function ($partner) {
                    Partner::destroy($partner->id);
                });

            $partners
                ->map(function ($partner) use (&$company) {
                    if (isset($partner['id'])) {

                        if(!isset($partner['registered_federal_revenue'])) {
                            $partner['registered_federal_revenue'] = 0;
                        }

                        Partner
                            ::where('company_id', $company->id)
                            ->where('id', $partner['id'])
                            ->update($partner);
                    } else {
                        $partner['company_id'] = $company->id;
                        Partner::create($partner);
                    }
                });

            // Remove/cria novos Responsaveis
            $company->load('responsibles');
            $company->responsibles->load('user');

            $company
                ->responsibles
                ->whereNotIn('id', $responsibles->pluck('id')->filter())
                ->map(function ($responsible) {
                    Responsible::destroy($responsible->id);
                });

            $responsibles
                ->map(function ($responsible) use (&$company) {
                    if(isset($responsible['user_id'])) {
                        $responsible['company_id'] = $company->id;
                        Responsible::create($responsible);
                    }
                });


        }, $retryTimes);

        return redirect()->route('companies.edit', $company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }

    public function files(Company $company)
    {
        session(['company_id' => $company->id, 'company_name' => $company->fancy_name]);

        $base_dir = 'public/files/companies';

        $company_dir = "{$base_dir}/{$company->id}";

        Storage::makeDirectory($company_dir);

        Folder
            ::all()
            ->map(function ($folder) use (&$company_dir) {
                Storage::makeDirectory("{$company_dir}/$folder->name");
            });

        return view('companies.files', compact('company'));
    }
}
