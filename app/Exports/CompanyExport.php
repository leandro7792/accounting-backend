<?php

namespace App\Exports;

use App\Password;
use App\ReportConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class CompanyExport implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $table[] = [
            'Grupo',
            'Responsável',
            'Código',
            'CNPJ',
            'Regime tributário',
            'Nome Corporativo',
            'Cidade',
            'Email',
            'Data de Vencimento',
            'Valor',
            'Observações',
            'Senhas',
        ];

        $roles = Auth::user()->getRoleNames();

        $roleSearch = $roles[0] === "super-admin" ? "%" : $roles[0];

        $data = DB::select(
            "SELECT
                companies.id AS company_id,
                roles.name AS role,
                users.name AS user,
                companies.code AS code,
                companies.cnpj AS cnpj,
                company_types.initials AS company_type,
                companies.corporate_name AS corporate_name,
                companies.city AS city,
                companies.email as email,
                companies.f1 as f1,
                companies.f2 as f2,
                companies.comments as comments
            FROM model_has_roles
            INNER JOIN roles ON model_has_roles.role_id = roles.id
            INNER JOIN users ON model_has_roles.model_id = users.id
            INNER JOIN responsibles ON responsibles.user_id = users.id
            INNER JOIN companies ON companies.id = responsibles.company_id
            INNER JOIN company_types ON company_types.id = companies.company_type_id
            WHERE responsibles.deleted_at IS null AND roles.name LIKE ?;",
            [$roleSearch]
        );

        $curentRole = Role::where(['name' => $roles[0]])->first();

        $reportConfig = ReportConfig
                                ::where('role_id', $curentRole->id)
                                ->first();

        collect($data)->map(function ($row) use (&$table, $reportConfig) {

            $passwords = Password::where('company_id', $row->company_id)->get();

            $row->passwords = '';

            foreach ($passwords as $password) {
                $row->passwords .=  "{$password->identification}: {$password->user}/{$password->password} - ";
            }

            unset($row->company_id);

            if ($reportConfig) {
                if($reportConfig->code === 0) {
                    unset($row->code);
                    unset($table[0][2]);
                }

                if($reportConfig->cnpj === 0) {
                    unset($row->cnpj);
                    unset($table[0][3]);
                }

                if($reportConfig->company_type === 0) {
                    unset($row->company_type);
                    unset($table[0][4]);
                }

                if($reportConfig->corporate_name === 0) {
                    unset($row->corporate_name);
                    unset($table[0][5]);
                }

                if($reportConfig->city === 0) {
                    unset($row->city);
                    unset($table[0][6]);
                }

                if($reportConfig->contact_mails === 0) {
                    unset($row->email);
                    unset($table[0][7]);
                }

                if($reportConfig->f1 === 0) {
                    unset($row->f1);
                    unset($table[0][8]);
                }

                if($reportConfig->f2 === 0) {
                    unset($row->f2);
                    unset($table[0][9]);
                }

                if($reportConfig->comments === 0) {
                    unset($row->comments);
                    unset($table[0][10]);
                }

                if($reportConfig->passwords === 0) {
                    unset($row->passwords);
                    unset($table[0][11]);
                }
            }

            $table[] = $row;
        });

        return collect($table);
    }
}
