<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\CompanyExport;
use App\ReportConfig;
use App\Responsible;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Guid\Fields;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles =  Role::where('name', 'not like', 'super-admin')->get();

        return view('reports.index', compact('roles'));
    }

    public function export()
    {
        return Excel::download(new CompanyExport(), 'relatorio.xlsx');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $configs = ReportConfig::where('role_id', $role->id)->first();

        $fields = [
            [
                'field' => 'code',
                'label' => 'Código',
                'checked' => $configs->code ?? 0,
            ],
            [
                'field' => 'cnpj',
                'label' => 'CNPJ',
                'checked' => $configs->cnpj ?? 0,
            ],
            [
                'field' => 'company_type',
                'label' => 'Regime Tributário',
                'checked' => $configs->company_type ?? 0,
            ],
            [
                'field' => 'corporate_name',
                'label' => 'Nome corporativo',
                'checked' => $configs->corporate_name ?? 0,
            ],
            [
                'field' => 'city',
                'label' => 'Cidade',
                'checked' => $configs->city ?? 0,
            ],
            [
                'field' => 'passwords',
                'label' => 'Senhas',
                'checked' => $configs->passwords ?? 0,
            ],
            [
                'field' => 'contact_mails',
                'label' => 'Email de contato',
                'checked' => $configs->contact_mails ?? 0,
            ],
            [
                'field' => 'comments',
                'label' => 'Observações',
                'checked' => $configs->comments ?? 0,
            ],
            [
                'field' => 'f1',
                'label' => 'Data de Vencimento',
                'checked' => $configs->f1 ?? 0,
            ],
            [
                'field' => 'f2',
                'label' => 'Valor',
                'checked' => $configs->f2 ?? 0,
            ],
        ];

        return view('reports.edit', compact('role', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'code' => 'nullable|boolean',
            'cnpj' => 'nullable|boolean',
            'company_type' => 'nullable|boolean',
            'corporate_name' => 'nullable|boolean',
            'city' => 'nullable|boolean',
            'passwords' => 'nullable|boolean',
            'contact_mails' => 'nullable|boolean',
            'comments' => 'nullable|boolean',
            'f1' => 'nullable|boolean',
            'f2' => 'nullable|boolean',
        ]);

        $validatedData['code'] = $validatedData['code'] ?? 0;
        $validatedData['cnpj'] = $validatedData['cnpj'] ?? 0;
        $validatedData['company_type'] = $validatedData['company_type'] ?? 0;
        $validatedData['cocorporate_namede'] = $validatedData['corporate_name'] ?? 0;
        $validatedData['passwords'] = $validatedData['passwords'] ?? 0;
        $validatedData['contact_mails'] = $validatedData['contact_mails'] ?? 0;
        $validatedData['comments'] = $validatedData['comments'] ?? 0;
        $validatedData['f1'] = $validatedData['f1'] ?? 0;
        $validatedData['f2'] = $validatedData['f2'] ?? 0;

        ReportConfig::updateOrCreate(['role_id' => $role->id], $validatedData);

        return redirect()->route('reports.index');
    }
}
