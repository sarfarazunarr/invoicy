<?php 
// app/Models/InvoiceProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_name',
        'quantity',
        'subprice',
        'total_price'
    ];
}