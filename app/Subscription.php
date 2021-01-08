<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $timestamps = true;

    protected $attributes = [
        'user_id'    => true,
        'package_id'    => true,         
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->select(['id', 'name']);
    }

    public function package()
    {
        return $this->belongsTo('App\CreditPackageMst', 'package_id')->select(['id', 'name']);
    }

    
}
