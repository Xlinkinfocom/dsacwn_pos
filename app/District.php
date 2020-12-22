<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{    

    protected $attributes = [
        'state_id'  => true,
        'name'      => true,       
    ];

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id')->select(['id', 'name']);
    }
}
