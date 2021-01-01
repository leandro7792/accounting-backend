<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CompanyTypes = [
            [
                "name" => "SIMPLES NACIONAL",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "LUCRO PRESUMIDO",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "name" => "LUCRO REAL",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($CompanyTypes as $type) {
            DB::table('taxes')->insert($type);
        }
    }
}
