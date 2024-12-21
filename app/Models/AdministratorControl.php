<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorControl extends Model
{
    use HasFactory;

    protected $table = 'administrator_control';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'admin_name',
        'resumption_date',
        'adminsign',
        'no_of_days_jss',
        'no_of_days_ss',
        'no_of_days',
        'school_name',
        'school_address1',
        'school_address2',
        'school_logo',
        'session1',
        'term',
        'school_type',
        'term_end',
    ];
}
