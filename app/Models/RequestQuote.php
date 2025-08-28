<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'exhibition',
        'name',
        'company_name',
        'email',
        'phone',
        'country',
        'designation',
        'role',
        'subject',
        'message',
        'product_name'
    ];

    public function product()
{
    return $this->belongsTo(Product::class, 'product_name', 'product_name');
}
}
