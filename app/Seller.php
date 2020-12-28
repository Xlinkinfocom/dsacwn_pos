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
        return $this->belongsTo('App\State', 'state_id')->select(['id', 'name']);
    }

    public function bstate()
    {
        return $this->belongsTo('App\State', 'bstate_id')->select(['id', 'name']);
    }

    public function district()
    {
        return $this->belongsTo('App\District', 'district_id')->select(['id', 'name']);
    }

    public function bdistrict()
    {
        return $this->belongsTo('App\District', 'bdistrict_id')->select(['id', 'name']);
    }
}
