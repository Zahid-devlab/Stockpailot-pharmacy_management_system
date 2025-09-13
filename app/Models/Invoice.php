<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'total',
        'discount',
        'vat',
        'payable',
        'customer_id',
        'user_id',
        'due',
    ];

    function customer() {
        return $this->belongsTo(Customer::class);
    }
    function invoiceProduct() {
        return $this->hasMany(InvoiceProduct::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
