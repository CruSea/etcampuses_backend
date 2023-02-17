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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->String('firstName');
            $table->String('lastName');
            $table->String('email')->unique()->collation('latin1_general_cs');
            $table->String('password')->collation('latin1_general_cs');
            $table->String('phone')->unique();
            $table->unsignedBigInteger('promotedBy');
            $table->String('profilePicture');
            $table->String('theme');
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
        Schema::dropIfExists('users');
    }
};
