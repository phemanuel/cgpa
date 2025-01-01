<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable= [
        'instructor_id',
        'instructor_name',
        'course_id',
        'course_title',
        'course_code',
        'course_unit',
        'semester',
        'department',
        'level',
        'assign_status',
    ];
}
