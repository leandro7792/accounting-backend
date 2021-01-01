<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


use App\Cnae;
use App\Http\Resources\Cnaes as CnaesResource;

use App\CompanyType;
use App\Http\Resources\CompanyType as CompanyTypeResource;

use App\CompanySize;
use App\Http\Resources\CompanySize as CompanySizeResource;

use App\Tax;
use App\Http\Resources\Tax as TaxResource;

use App\AdministrationType;
use App\Http\Resources\AdministrationType as AdministrationTypeResource;


use App\Company;
use App\Activity;
use App\Contact;
use App\Mail\NewCompanyRegistered;
use App\Partner;


Route::middleware(['auth:api'])->group(function () {

    Route::get('cnaes/{term}', function(Request $request) {
        $results = Cnae
                    ::where('description', 'like', "%{$request->term}%")
                    ->orWhere('code', 'like', "%{$request->term}%")
                    ->get();

        return  CnaesResource::collection($results);
    });

    Route::get('companies/types', function(Request $request) {
        return CompanyTypeResource::collection(CompanyType::all());
    });

    Route::get('companies/sizes', function(Request $request) {
        return CompanySizeResource::collection(CompanySize::all());
    });

    Route::get('companies/taxies', function(Request $request) {
        return TaxResource::collection(Tax::all());
    });

    Route::get('companies/administrationtypes', function(Request $request) {
        return AdministrationTypeResource::collection(AdministrationType::all());
    });

    /**
     * STORE DATA
     */
    Route::post('companies', function(Request $request) {


        $company = Company::create($request->company);

        Contact::create(
            array_merge(
                $request->contact,
                ['company_id' => $company->id]
            )
        );

        foreach ($request->activities as $activity) {
            Activity::create(
                array_merge(
                    $activity,
                    ['company_id' => $company->id]
                )
            );
        }

        // se for MEI
        if($company->company_type_id === 1) {
            Partner::create(
                array_merge(
                    $request->partiners[0],
                    $request->contact,
                    ['company_id' => $company->id]
                )
            );
        } else {
            foreach ($request->partiners as $partner) {
                Partner::create(
                    array_merge(
                        $partner,
                        ['company_id' => $company->id]
                    )
                );
            }
        }

        // Mail::to('jeison@7mais.com.br')->send(new NewCompanyRegistered($company));

        return response()->json($company, 201);
    });

    Route::post('contacts', function(Request $request) {

        $contact = Contact::create($request->contact);

        return response()->json($contact, 201);
    });
});
