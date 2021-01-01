<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /**
         * App auth
         */
        DB::table('users')->insert([
            'name' => 'APP_Access',
            'email' => 'app@admin.com',
            'password' => Hash::make('app'),
            'api_token' => Str::random(60),
        ]);

        /**
         * Default Admin user
         */
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
