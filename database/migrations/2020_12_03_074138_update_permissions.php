<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use App\User;

class UpdatePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'atribuir responsável']);

        Permission::
            where(['name' => 'salvar arquivos do cliente'])
            ->delete();

        Permission::
            where(['name' => 'remover arquivos do cliente'])
            ->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::create(['name' => 'remover arquivos do cliente']);

        Permission::create(['name' => 'salvar arquivos do cliente']);

        Permission::
            where(['name' => 'atribuir responsável'])
            ->delete();
    }
}
