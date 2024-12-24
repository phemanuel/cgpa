<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hod extends Model
{
    use HasFactory;

    protected $table = 'hods';

    protected $fillable = [
        'hod_name',
        'dept',
        'course',
        'sign',
    ];
}
