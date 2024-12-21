<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingSystem extends Model
{
    use HasFactory;

    protected $table = 'grading_system';

    protected $fillable = [
        'grade01', 'grade02', 'grade11', 'grade12', 'grade21', 'grade22', 'grade31', 
        'grade32', 'grade41', 'grade42', 'interpretation1', 'interpretation2', 
        'interpretation3', 'interpretation4', 'interpretation5', 'unit01', 'unit02', 
        'unit03', 'unit04', 'unit05', 'unit06', 'grade51', 'grade52', 'dept', 
        'arepeat', 'awithdraw', 'lgrade1', 'lgrade2', 'lgrade3', 'lgrade4', 'lgrade5', 'lgrade6',
    ];
}
