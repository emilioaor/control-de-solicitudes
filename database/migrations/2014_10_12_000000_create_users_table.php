<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('firstnames');
            $table->string('lastnames');
            $table->string('phone');
            $table->string('country');
            $table->string('state');
            $table->string('level');
            $table->string('password_temp')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->index(['user','email','password','password_temp']);
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
}
