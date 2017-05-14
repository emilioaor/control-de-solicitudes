<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('user_id')->unsigned();
            $table->integer('to_user')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('to_user')->references('id')->on('users');
            $table->integer('source')->nullable();
            $table->string('route_admin')->nullable();
            $table->string('route_user')->nullable();
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
        Schema::dropIfExists('notes');
    }
}
