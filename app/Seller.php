<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public $timestamps = true;

    protected $attributes = [

        'aacount_type'    => true,
        
    ];

    public function state()
    {
        return $this->belongsTo('App\State', ['state_id', 'bstate_id'])->select(['id', 'name']);
    }

    public function district()
    {
        return $this->belongsTo('App\District', 'district_id')->select(['id', 'name']);
    }
}
