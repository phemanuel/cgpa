<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';    

    protected $fillable = [
        'course_title',
        'course_code',
        'course_unit',
        'level',
        'semester',
        'course',
        'session1',
    ];

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'course_id', 'id');
    }
    
}
