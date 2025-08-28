<?php

namespace App\Models;

use App\Http\Controllers\WebController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    use HasFactory;

    protected $table = "careers";
    protected $fillable = [
        'name', 'email', 'phone', 'job_type', 'position', 'highest_qualification', 'board_university', 'year_of_experience', 'current_ctc', 'expected_ctc', 'resume'
    ];

    public function getResumeAttribute($value)
    {
        return WebController::getFile(config('constants.resume'), $value);
    }
}
