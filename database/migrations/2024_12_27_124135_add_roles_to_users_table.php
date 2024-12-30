<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('class_list');
            $table->integer('result');
            $table->integer('result_entry');
            $table->integer('result_compute');
            $table->integer('semester_result');
            $table->integer('semester_summary');
            $table->integer('cgpa_summary');
            $table->integer('student_transcript');
            $table->integer('course_setup');
            $table->integer('score_sheet');
            $table->integer('access_setup');
            $table->integer('admins');
            $table->integer('instructors');
            $table->integer('students');
            $table->integer('student');
            $table->integer('student_registration');
            $table->integer('student_migration');
            $table->integer('hod_setup');
            $table->integer('grading_system');
            $table->integer('transcript');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
