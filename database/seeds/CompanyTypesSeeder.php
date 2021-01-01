<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTypesSeeder extends Seeder
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
                "initials" => "MEI",
                "full_name" => "Microempreendedor Individual",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "initials" => "LTDA UNIPESSOAL",
                "full_name" => "Microempreendedor Individual - Unipessoal",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "initials" => "EI",
                "full_name" => "Empresário Individual",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "initials" => "EIRELI",
                "full_name" => "Empresa Individual de Responsabilidade Limitada",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "initials" => "LTDA",
                "full_name" => "Sociedade Limitada",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                "initials" => "SA",
                "full_name" => "Sociedade Anônima",
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        foreach ($CompanyTypes as $type) {
            DB::table('company_types')->insert($type);
        }
    }
}
