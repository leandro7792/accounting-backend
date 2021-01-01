<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/roles', 'RolesController')->except(['show'])->middleware('can:Gerenciar usuários');
    Route::resource('/users', 'UsersController')->except(['show'])->middleware('can:Gerenciar usuários');

    Route::middleware(['can:ver cliente'])->group(function () {

        Route::get('/companies', 'CompaniesController@index')->name('companies.index');
        Route::get('/companies/{company}', 'CompaniesController@show')->name('companies.show');
        Route::patch('/companies/{company}', 'CompaniesController@approve')->name('companies.approve')->middleware('can:aprovar cliente');
        Route::get('/companies/{company}/edit', 'CompaniesController@edit')->name('companies.edit')->middleware('can:editar cliente');
        Route::put('/companies/{company}', 'CompaniesController@update')->name('companies.update')->middleware('can:editar cliente');
        Route::delete('/companies/{company}', 'CompaniesController@destroy')->name('companies.destroy')->middleware('can:excluir cliente');

        Route::get('/passwords/{company}', 'PasswordsController@show')->name('passwords.show');
        Route::get('/passwords/{company}/edit', 'PasswordsController@edit')->name('passwords.edit')->middleware('can:editar senhas do cliente');
        Route::put('/passwords/{company}', 'PasswordsController@update')->name('passwords.update')->middleware('can:editar senhas do cliente');

        Route::get('/companies/{company}/files', 'CompaniesController@files')->name('companies.files');

        Route::get('/files', 'FilesController@index')->name('files.index');
        Route::put('/files', 'FilesController@update')->name('files.update');

        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        Route::get('/contacts', 'ContactsController@index')->name('contacts.index');
        Route::get('/contacts/{contact}', 'ContactsController@show')->name('contacts.show');
        Route::get('/contacts/{contact}/create', 'ContactsController@create')->name('contacts.create');
        Route::delete('/contacts/{contact}', 'ContactsController@destroy')->name('contacts.destroy')->middleware('can:excluir cliente');

        Route::get('/reports', 'ReportsController@index')->name('reports.index');
        Route::get('/reports/export', 'ReportsController@export')->name('reports.export');
        Route::get('/reports/{role}', 'ReportsController@edit')->name('reports.edit');
        Route::put('/reports/{role}', 'ReportsController@update')->name('reports.update');
    });

});
