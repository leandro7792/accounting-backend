<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'cnae_id',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function cnae()
    {
        return $this->belongsTo('App\Cnae');
    }
}
