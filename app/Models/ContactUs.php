<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'product_id', 'country', 'subject', 'message'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}
}
