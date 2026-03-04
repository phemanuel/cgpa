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
        Schema::create('result_resits', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no');
            $table->string('student_name');
            $table->string('class');
            $table->string('semester');
            $table->string('course_title');
            $table->string('course_code');
            $table->decimal('failed_score', 5, 2);
            $table->decimal('resit_score', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_resits');
    }
};
