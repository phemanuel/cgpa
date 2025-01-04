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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('instructor_id');
            $table->string('instructor_name', 50);
            $table->unsignedBigInteger('course_id');
            $table->string('course_title', 100);
            $table->string('course_code', 10);
            $table->decimal('course_unit', 3, 2);
            $table->string('department', 50);
            $table->string('programme', 50);
            $table->string('semester', 10);
            $table->string('level', 10);
            $table->string('session1', 20);
            $table->string('assign_status')->default('Inactive'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
