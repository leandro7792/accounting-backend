<?php

namespace App\Http\Controllers;

use App\Company;
use App\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasswordsController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

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
        $company->load('passwords');

        return view('passwords.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company->load('passwords');

        return view('passwords.edit', compact('company'));
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
            'password' => 'nullable|array',
            'password.*.id' => 'nullable|exists:passwords,id',
            'password.*.identification' => 'required|string',
            'password.*.user' => 'required|string',
            'password.*.password' => 'required|string',
            'password.*.comments' => 'required|string',
        ]);

        $retryTimes = 1;
        DB::transaction(function () use (&$validatedData, &$company) {

            $passwords = collect($validatedData['password']);

            $company->load('passwords');
            $company
                ->passwords
                ->whereNotIn('id', $passwords->pluck('id')->filter())
                ->map(function ($password) {
                    Password::destroy($password->id);
                });

            $passwords
                ->map(function ($password) use (&$company) {
                    if (isset($password['id'])) {
                        Password
                            ::where('company_id', $company->id)
                            ->where('id', $password['id'])
                            ->update($password);
                    } else {
                        $password['company_id'] = $company->id;
                        Password::create($password);
                    }
                });
        }, $retryTimes);

        return redirect()->route('passwords.edit', $company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
