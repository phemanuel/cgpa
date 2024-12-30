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
        Schema::create('course_study', function (Blueprint $table) {
            $table->id();
            $table->string('dept'); 
            $table->string('dept_name');
            $table->string('dept_duration'); 
            $table->string('dept_abbr');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_study');
    }
};
