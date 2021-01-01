<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \JsonMachine\JsonMachine;

class CnaesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonPath = __DIR__ . "/cnaes.json";

        $json = JsonMachine::fromFile($jsonPath);

        DB::table('cnaes')->delete();

        foreach ($json as $cnae) {
            DB::table('cnaes')->insert([
                'code' => $cnae['id'],
                'description' => implode("; ", $cnae['atividades']),
                'comments' => implode("r/n/", $cnae['observacoes']),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
