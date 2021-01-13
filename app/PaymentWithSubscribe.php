<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentWithSubscribe extends Model
{
    protected $table    = 'payment_with_subscripe';
    //protected $fillable = ['user_id', 'payment_reference', 'transaction_id', 'payment_status', 'payment_date'];
    //protected $visible  = ['id', 'user_id', 'payment_reference', 'transaction_id', 'payment_status', 'payment_date'];
    public $timestamps  = true;
}
