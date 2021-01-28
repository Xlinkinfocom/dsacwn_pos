<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stransaction extends Model
{
    public $timestamps = true;

    protected $attributes = [
        'seller_id'             => true,
        'invoice_id'            => true,
        'invoice_date'          => true,
        'sale_value'            => true,
        'seller_payable_amount' => true,
    ];

    public function seller()
    {
    	return $this->belongsTo('App\Seller', 'seller_id')->select(['id', 'seller_name']);
    }

    public function sale()
    {
        return $this->belongsTo('App\Sale', 'invoice_id');
    }
   
}
