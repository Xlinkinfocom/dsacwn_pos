<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quick_Sale extends Model
{
    protected $table = 'quick_sales';
    protected $fillable =[
        "reference_no", "user_id", "warehouse_id", "biller_id", "customer_name", "item", "total_qty", "total_tax", "total_price", "grand_total", "sale_status", "payment_status", "paid_amount", "by_cash", "by_card", "sale_note", "staff_note", "payment_note", "paying_method", "quick_change"
    ];
}
