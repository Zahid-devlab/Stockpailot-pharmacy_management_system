<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'unit', 'img_url', 'category_id', 'user_id'
    ];

    function invoiceProduct() {
        return $this->hasMany(InvoiceProduct::class);
    }

}
