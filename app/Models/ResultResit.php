<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultResit extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_no',
        'student_name',
        'class',
        'semester',
        'course_title',
        'course_code',
        'failed_score',
        'resit_score',
    ];
}
