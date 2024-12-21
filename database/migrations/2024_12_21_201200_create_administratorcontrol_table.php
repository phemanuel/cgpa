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
        Schema::create('administrator_control', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name')->nullable(); 
            $table->date('resumption_date')->nullable(); 
            $table->string('admin_sign')->nullable(); 
            $table->integer('no_of_days_jss')->nullable(); 
            $table->integer('no_of_days_ss')->nullable(); 
            $table->integer('no_of_days')->nullable(); 
            $table->string('school_name')->nullable(); 
            $table->string('school_address1')->nullable(); 
            $table->string('school_address2')->nullable(); 
            $table->string('school_logo')->nullable(); 
            $table->string('session1')->nullable(); 
            $table->string('term')->nullable(); 
            $table->string('school_type')->nullable(); 
            $table->date('term_end')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrator_control');
    }
};
