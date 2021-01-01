<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'phone',
        'email',
        'marital_status',
        'wedding_type',
        'notary_public',
        'naturalness',
        'registered_federal_revenue',
        'pro_labore',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
