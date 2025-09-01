<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug', 'category_id','sort_order', 'product_name', 'product_size', 'product_description',
        'product_main_image', 'product_image_1', 'product_heading_1', 'product_image_2', 'product_heading_2', 'product_image_3', 'product_heading_3', 'related_products',
        'features', 'product_technical_specifications_information', 'breadcrumb_name',
        'meta_keyword', 'meta_title', 'meta_description', 'status'
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}