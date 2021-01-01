<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportConfig extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'role_id',
        'code',
        'cnpj',
        'company_type',
        'corporate_name',
        'city',
        'passwords',
        'contact_mails',
        'comments',
        'f1', // data de vencimento
        'f2', // valor'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
