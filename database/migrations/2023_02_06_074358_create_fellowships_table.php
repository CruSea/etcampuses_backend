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
        Schema::create('fellowships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campusID');
            $table->foreign('campusID')->references('id')->on('campuses');
            $table->string('title');
            $table->string('members');
            $table->string('membersCaption');
            $table->string('teams');
            $table->string('teamsCaption');
            $table->string('services');
            $table->string('servicesCaption');
            $table->string('image');
            $table->string('bgColor');
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
        Schema::dropIfExists('fellowships');
    }
};
