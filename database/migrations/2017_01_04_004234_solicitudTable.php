<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('read');
            $table->timestamps();
        });

        Schema::create('solicitudes_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('service_id')->references('id')->on('services');
            $table->integer('price')->nullable()->default(0);
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
        Schema::dropIfExists('solicitudes_services');
        Schema::dropIfExists('solicitudes');
    }
}
