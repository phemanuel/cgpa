<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Registration extends Authenticatable
{
    use HasFactory;

    protected $table = 'registrations';  

    protected $primaryKey = 'id';  

    protected $fillable = [
        'admission_no',
        'reg_no',
        'sn',
        'admission_year',
        'result_year',
        'first_name',
        'surname',
        'course',
        'other_name',
        'class',
        'ident_status',
        'picture_dir',
        'gender',
        'student_full_name',
        'phone_no',
        'address',
        'state',
        'dob',
        'acad_session',
        'lga',
        'migrate_status',
    ];

    protected $hidden = [
        'password',
    ];
}
