<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'exhibition_name',
        'exhibition_start_date',
        'exhibition_end_date',
        'exhibition_location',
        'exhibition_description',
        'exhibition_photo',
        'exhibition_images',
        'breadcrumb_name',
        'breadcrumb_description',
        'breadcrumb_photo',
        'meta_keyword',
        'meta_title',
        'meta_description',
        'status',
    ];
}
