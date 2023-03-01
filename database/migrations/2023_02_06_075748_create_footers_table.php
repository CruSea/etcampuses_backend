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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campusID');
            $table->foreign('campusID')->references('id')->on('campuses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('socialMediasCaption');
            $table->string('bgColor');
            $table->string('contactUsCaption');
            $table->string('email');
            $table->string('phone');
            $table->string('findUsCaption');
            $table->string('termsAndConditions');
            $table->string('termsAndConditionsCaption');
            $table->string('mapLink');
            $table->string('copyrightCaption');
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
        Schema::dropIfExists('footers');
    }
};
