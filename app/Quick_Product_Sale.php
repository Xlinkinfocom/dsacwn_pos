<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quick_Product_Sale extends Model
{
	protected $table = 'quick_product_sales';
    protected $fillable =[
        "sale_id", "product_name", "qty", "sale_unit", "net_unit_price", "tax_rate", "tax", "total"
    ];
}
