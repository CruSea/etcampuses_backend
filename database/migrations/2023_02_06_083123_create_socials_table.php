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
        Schema::create('social', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campusID');
            $table->foreign('campusid')->references('id')->on('campuses');
            $table->string('facebookLink');
            $table->string('telegramLink');
            $table->string('instagramLink');
            $table->string('youtubeLink');
            $table->string('tiktokLink');
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
        Schema::dropIfExists('socials');
    }
};
