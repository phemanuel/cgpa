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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');            
            $table->string('phone_no')->nullable();            
            $table->string('user_type')->nullable();
            $table->enum('user_type_status', ['1', '2', '3'])           
            ->comment('1: Admin, 2: Instructor, 3: Student');
            $table->integer('email_verified_status')->nullable();
            $table->integer('login_attempts')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
