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
        Schema::create('campusadmin', function (Blueprint $table) {
            $table->id();
            $table->String('firstName');
            $table->String('lastName');
            $table->String('email')->unique();
            $table->String('password');
            $table->String('phone')->unique();
            $table->String('approvedBy')->nullable();
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
        Schema::dropIfExists('campusadmin');
    }
};
