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
        //
        Schema::create('result_computes', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no', 20); 
            $table->string('surname', 50); 
            $table->string('first_name', 50); 
            $table->string('other_name', 50)->nullable(); 
            $table->string('class', 20); 
            $table->string('semester', 20); 
            $table->string('picture_dir', 20)->nullable(); 
            $table->string('course', 100); 
            $table->unsignedTinyInteger('sn')->nullable(); 
            $table->unsignedTinyInteger('no_of_course'); 
            $table->string('session1', 20); 
            $table->decimal('gtotal', 5, 2)->nullable();
            $table->decimal('gpa', 5, 2)->nullable();
            $table->integer('total_course_unit')->nullable();
            $table->string('student_full_name', 100);
            $table->decimal('gpa1', 5, 2)->nullable();
            $table->decimal('gpa2', 5, 2)->nullable();
            $table->decimal('cgpa', 5, 2)->nullable();
            $table->decimal('cgpa1', 5, 2)->nullable();
            $table->decimal('cgpa2', 5, 2)->nullable();
            $table->decimal('cgpa3', 5, 2)->nullable();
            $table->decimal('total_cgpa', 5, 2)->nullable();
            $table->string('remark', 20)->nullable();
            $table->string('failed_course', 50)->nullable();
            $table->string('failed_course1' , 10)->nullable();
            $table->string('failed_course2' , 10)->nullable();
            $table->unsignedTinyInteger('all_total_failed_course', 50)->nullable();
            $table->unsignedTinyInteger('total_failed_course')->nullable();
            $table->string('cgpa_remark', 20)->nullable();
            $table->string('promoted', 10)->nullable();
            $table->decimal('total_grade_point', 5, 2)->nullable();
            $table->decimal('all_total_grade_point', 5, 2)->nullable();
            $table->unsignedTinyInteger('total_course_unit_new')->nullable();
            $table->unsignedTinyInteger('all_total_course_unit')->nullable();
            $table->decimal('total_cgpa_new', 5, 2)->nullable();
            $table->decimal('total_grade_point_new', 5, 2)->nullable();
            $table->string('total_remark', 20)->nullable();

            // Generate fields for scores and subjects
            for ($i = 1; $i <= 19; $i++) {               
                $table->string("subject{$i}", 60)->nullable(); 
            }

            for ($i = 1; $i <= 19; $i++) {
                $table->decimal("ctotal{$i}", 5, 2)->nullable();                
            }

            for ($i = 1; $i <= 17; $i++) {
                $table->string("subjectgrade{$i}", 3)->nullable();                
            }

            for ($i = 1; $i <= 19; $i++) {               
                $table->decimal("score{$i}", 5,2)->nullable(); 
            }

            // Generate fields for units
            for ($i = 1; $i <= 18; $i++) {
                $table->unsignedTinyInteger("unit{$i}")->nullable();
            }

            // Generate fields for course titles
            for ($i = 1; $i <= 17; $i++) {
                $table->string("ctitle{$i}", 100)->nullable();
            }

            for ($i = 1; $i <= 15; $i++) {               
                $table->string("carryover{$i}", 10)->nullable(); 
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('result_computes');
    }
};
