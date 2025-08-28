<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $fillable = [
        'page',
        'breadcrumb_name',
        'breadcrumb_description',
        'breadcrumb_image',
        'meta_keyword',
        'meta_title',
        'meta_description',
    ];
}

