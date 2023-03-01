<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campusID');
            $table->foreign('campusID')->references('id')->on('campuses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('city');
            $table->string('language');
            $table->string('sex');
            $table->string('phone');
            $table->boolean('isHostAvailable');
            $table->string('church');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
