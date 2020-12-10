<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[

        "purchase_id", "user_id", "sale_id", "account_id", "payment_reference", "amount", "change", "by_cash", "by_card", "paying_method", "payment_note"
    ];
}
