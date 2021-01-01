<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySizesSeeder extends Seeder
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
                "initials" => "ME",
                "full_name" => "Microempresa Individual",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "initials" => "EPP",
                "full_name" => "Empresa de Pequeno Porte",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($CompanyTypes as $type) {
            DB::table('company_sizes')->insert($type);
        }
    }
}
