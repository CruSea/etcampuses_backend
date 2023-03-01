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
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->string('services_Title');
            $table->string('teams_Title');
            $table->string('teams_Description');
            $table->string('leaders_Title');
            $table->string('leaders_BgColor');
            $table->string('gallery_Title');
            $table->boolean('isBlocked')->default(false);
            $table->string('url');
            $table->boolean('isPublished')->default(false);
            $table->string('owner');
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
        Schema::dropIfExists('campuses');
    }
};
