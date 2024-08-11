<?php
// app/Models/Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'total',
        'payment_method',
        'payment_status'
    ];
    public function products()
    {
        return $this->hasMany(InvoiceProduct::class, 'invoice_id');
    }
}