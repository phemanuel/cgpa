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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no', 20); 
            $table->string('surname', 50); 
            $table->string('first_name', 50); 
            $table->string('other_name', 50)->nullable(); 
            $table->string('class', 20); 
            $table->string('semester', 20); 
            $table->string('picture_dir', 20)->nullable(); 
            $table->string('course', 100); 
            $table->unsignedTinyInteger('no_of_course'); 
            $table->string('session1', 20); 

            // Generate fields for scores and subjects
            for ($i = 1; $i <= 19; $i++) {
                $table->decimal("score{$i}", 5, 1)->nullable(); 
                $table->string("subject{$i}", 60)->nullable(); 
            }

            // Generate fields for units
            for ($i = 1; $i <= 18; $i++) {
                $table->unsignedTinyInteger("unit{$i}")->nullable();
            }

            // Generate fields for course titles
            for ($i = 1; $i <= 17; $i++) {
                $table->string("ctitle{$i}", 100)->nullable();
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
