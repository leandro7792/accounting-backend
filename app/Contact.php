<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'phone',
        'email',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
