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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no')->unique();
            $table->string('reg_no');
            $table->string('admission_year');
            $table->string('result_year');
            $table->string('first_name');
            $table->string('surname');
            $table->string('course');
            $table->string('other_name')->nullable();
            $table->string('class');
            $table->string('ident_status');
            $table->string('picture_dir');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('student_full_name');
            $table->string('phone_no');
            $table->text('address');
            $table->string('state');
            $table->date('dob');
            $table->string('acad_session');
            $table->string('lga');
            $table->boolean('migrate_status')->default(false);
            $table->unsignedTinyInteger('sn', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
