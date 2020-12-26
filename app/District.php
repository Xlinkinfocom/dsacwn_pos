<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{    

    protected $attributes = [
        'state_id'  => true,
        'name'      => true,       
    ];

    
}
