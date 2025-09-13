<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'sale_price',
        'qty',
        'user_id',
        'buy_price',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }


}
