<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'slug',
        'blog_name',
        'blog_date',
        'blog_location',
        'blog_description',
        'blog_main_image',
        'blog_images',
        'breadcrumb_name',
        'breadcrumb_description',
        'breadcrumb_photo',
        'meta_keyword',
        'meta_title',
        'meta_description',
        'status'
    ];

    protected $casts = [
        'blog_images' => 'array',
    ];
}
