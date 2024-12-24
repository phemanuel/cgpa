<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultCompute extends Model
{
    use HasFactory;

    protected $table = 'result_computes';

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
                'gtotal',
                'gpa',
                'total_course_unit',
                'student_full_name',
                'gpa1',
                'gpa2',
                'cgpa',
                'cgpa1',
                'cgpa2',
                'cgpa3',
                'total_cgpa',
                'remark',
                'failed_course',
                'failed_course1',
                'failed_course2',
                'total_failed_course',
                'cgpa_remark',
                'promoted',
                'total_grade_point',
                'all_total_grade_point',
                'total_course_unit_new',
                'all_total_course_unit',
                'total_cgpa_new',
                'total_remark',
            ],
                array_map(fn($i) => "subject{$i}", range(1, 19)),
                array_map(fn($i) => "ctotal{$i}", range(1, 19)),
                array_map(fn($i) => "subjectgrade{$i}", range(1, 17)),
                array_map(fn($i) => "score{$i}", range(1, 19)),
                array_map(fn($i) => "unit{$i}", range(1, 18)),
                array_map(fn($i) => "ctitle{$i}", range(1, 17)),
                array_map(fn($i) => "carryover{$i}", range(1, 15)),
        );
    }
}
