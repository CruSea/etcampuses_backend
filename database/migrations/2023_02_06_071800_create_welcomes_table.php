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
        Schema::create('welcome', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campusID');
            $table->foreign('campusID')->references('id')->on('campuses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('image');
            $table->string('title');
            $table->string('campusName');
            $table->string('moto');
            $table->string('registerButtonText');
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
        Schema::dropIfExists('welcomes');
    }
};
