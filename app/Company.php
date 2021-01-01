<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public $with = ['company_type'];

    protected $fillable = [
        'code',
        'cnpj',
        'corporate_name',
        'fancy_name',
        'phone',
        'email',
        'share_capital',
        'address',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'company_type_id',
        'company_size_id',
        'tax_id',
        'administration_type_id',
        'f1',
        'f2',
        'f3',
        'f4',
        'f5',
        'comments'
    ];

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function Responsibles()
    {
        return $this->hasMany('App\Responsible');
    }

    public function partners()
    {
        return $this->hasMany('App\Partner');
    }

    public function company_type()
    {
        return $this->belongsTo('App\CompanyType');
    }

    public function company_size()
    {
        return $this->belongsTo('App\CompanySize');
    }

    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }

    public function administration_type()
    {
        return $this->belongsTo('App\AdministrationType');
    }

    public function passwords()
    {
        return $this->hasMany('App\Password');
    }
}
