<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'certificate_name',
        'certificate_photo',
        // 'breadcrumb_name',
        // 'breadcrumb_description',
        // 'meta_keyword',
        // 'meta_title',
        // 'meta_description',
        'status',
    ];
}

