<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

use App\User;

class AuthorizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Reset cached roles and permissions
         app()[PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
        //  Permission::create(['name' => 'manage users']);

        //  Permission::create(['name' => 'approve company']);
        //  Permission::create(['name' => 'read company']);
        //  Permission::create(['name' => 'edit company']);
        //  Permission::create(['name' => 'remove company']);

        //  Permission::create(['name' => 'read company passwords']);
        //  Permission::create(['name' => 'create company passwords']);
        //  Permission::create(['name' => 'edit company passwords']);
        //  Permission::create(['name' => 'remove company passwords']);

        //  Permission::create(['name' => 'read company files']);
        //  Permission::create(['name' => 'upload company files']);
        //  Permission::create(['name' => 'remove company files']);

        Permission::create(['name' => 'gerenciar usuários']);

        Permission::create(['name' => 'aprovar cliente']);
        Permission::create(['name' => 'ver cliente']);
        Permission::create(['name' => 'editar cliente']);
        Permission::create(['name' => 'excluir cliente']);

        Permission::create(['name' => 'ver senhas do cliente']);
        Permission::create(['name' => 'cadastrar senhas do cliente']);
        Permission::create(['name' => 'editar senhas do cliente']);
        Permission::create(['name' => 'excluir senhas do cliente']);

        Permission::create(['name' => 'ver arquivos do cliente']);
        Permission::create(['name' => 'salvar arquivos do cliente']);
        Permission::create(['name' => 'remover arquivos do cliente']);


         $role = Role::create(['name' => 'super-admin']);
         Role::create(['name' => 'admin']);
         // gets all permissions via Gate::before rule; see AuthServiceProvider

         $user = User::find(2);
         // SuAdmin User

         $user->assignRole($role);
    }
}
