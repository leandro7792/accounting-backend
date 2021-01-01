<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Folder::all();

        return view('files.index', compact('files'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'files' => 'required|array',
            'files.*.id' => 'nullable|exists:passwords,id',
            'files.*.name' => 'required|string',
        ]);

        $retryTimes = 1;
        DB::transaction(function () use (&$validatedData) {
            $files = collect($validatedData['files']);

            Folder
                ::all()
                ->whereNotIn('id', $files->pluck('id')->filter())
                ->map(function ($folder) {
                    Folder::destroy($folder->id);
                });

            $files
                ->map(function ($file) use (&$company) {
                    if (isset($file['id'])) {
                        Folder
                            ::where('id', $file['id'])
                            ->update($file);
                    } else {
                        Folder::create($file);
                    }
                });
        }, $retryTimes);

        return redirect()->route('files.index');
    }
}
