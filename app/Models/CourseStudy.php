<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudy extends Model
{
    use HasFactory;

    protected $table = 'course_study';

    protected $fillable = [
        'dept',
        'dept_name',
    ];
}
