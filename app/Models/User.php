<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'phone_no',        
        'user_type',
        'user_type_status',
        'email_verified_status',
        'login_attempts',
        'class_list',
        'course_setup',
        'score_sheet',
        'grading_system',
        'access_setup',
        'admins',
        'instructors',
        'students',
        'hod_setup',
        'result',
        'student',
        'result_entry',
        'student_registration',
        'result_compute',
        'student_migration',
        'semester_result',
        'semester_summary',
        'cgpa_summary',
        'student_transcript',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
