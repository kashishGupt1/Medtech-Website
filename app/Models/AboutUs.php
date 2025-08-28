<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'title', 'main_image', 'we_description',
        'v_title', 'v_description', 'm_title', 'm_description', 'why_choose_title', 'why_choose_description',
        'why_choose', 'breadcrumb_name', 'breadcrumb_description', 'breadcrumb_photo',
        'meta_keyword', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'why_choose' => 'array',
    ];
}

