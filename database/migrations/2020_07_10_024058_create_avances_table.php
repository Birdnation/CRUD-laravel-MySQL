<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('texto');
            $table->string('evidencia')->nullable();
            $table->integer('bitacora_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            //Claves foraneas de la entidad progreso
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bitacora_id')->references('id')->on('bitacoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avances');
    }
}
