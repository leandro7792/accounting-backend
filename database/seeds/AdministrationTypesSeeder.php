<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $AdministrationTypes = [
            [
                "name" => "ISOLADAMENTE",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "EM CONJUNTO E ISOLADAMENTE",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "SEMPRE CONJUNTO",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "ADMINISTRADOR",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($AdministrationTypes as $type) {
            DB::table('administration_types')->insert($type);
        }
    }
}
