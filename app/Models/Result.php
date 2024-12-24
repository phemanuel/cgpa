<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable;

    public function __construct()
    {
        $this->fillable = array_merge(
            [
                'admission_no',
                'surname',
                'first_name',
                'other_name',
                'class',
                'semester',
                'picture_dir',
                'course',
                'no_of_course',
                'session1',
            ],
            array_map(fn($i) => "score{$i}", range(0, 18)),
            array_map(fn($i) => "subject{$i}", range(0, 18)),
            array_map(fn($i) => "unit{$i}", range(0, 17)),
            array_map(fn($i) => "ctitle{$i}", range(0, 16))
        );
    }
}
