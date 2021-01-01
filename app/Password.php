<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'identification',
        'user',
        'password',
        'comments',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
