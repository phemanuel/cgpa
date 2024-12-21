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
        Schema::create('grading_system', function (Blueprint $table) {
            $table->id();
            $table->string('grade01');
            $table->string('grade02');
            $table->string('grade11');
            $table->string('grade12');
            $table->string('grade21');
            $table->string('grade22');
            $table->string('grade31');
            $table->string('grade32');
            $table->string('grade41');
            $table->string('grade42');
            $table->string('interpretation1');
            $table->string('interpretation2');
            $table->string('interpretation3');
            $table->string('interpretation4');
            $table->string('interpretation5');
            $table->string('unit01');
            $table->string('unit02');
            $table->string('unit03');
            $table->string('unit04');
            $table->string('unit05');
            $table->string('unit06');
            $table->string('grade51');
            $table->string('grade52');
            $table->string('dept');
            $table->string('arepeat'); 
            $table->string('awithdraw'); 
            $table->string('lgrade1');
            $table->string('lgrade2');
            $table->string('lgrade3');
            $table->string('lgrade4');
            $table->string('lgrade5');
            $table->string('lgrade6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_system');
    }
};
