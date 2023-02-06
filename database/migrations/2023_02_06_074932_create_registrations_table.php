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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campusID');
            $table->foreign('campusID')->references('id')->on('campuses');
            $table->string('title');
            $table->string('description');
            $table->string('firstNameCaption');
            $table->string('lastNameCaption');
            $table->string('cityCaption');
            $table->string('languageCaption');
            $table->string('sexCaption');
            $table->string('maleCaption');
            $table->string('femaleCaption');
            $table->string('phoneNumberCaption');
            $table->string('isHostAvailableCaption');
            $table->string('yesCaption');
            $table->string('noCaption');
            $table->string('buttonName');
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
        Schema::dropIfExists('registrations');
    }
};
