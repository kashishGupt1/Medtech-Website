<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'category_name',
        'short_description',
        'category_image',
        'breadcrumb_name',
        'breadcrumb_description',
        'breadcrumb_image',
        'meta_keyword',
        'meta_title',
        'meta_description',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function getCategoryImageUrlAttribute()
    {
        return $this->category_image
            ? asset('storage/' . $this->category_image)
            : asset('admin/images/avatars/avatar-2.png');
    }
}

