<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->string('ot');
            $table->unsignedBigInteger('vehiculo_id')->nullable();
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('hora_ingreso');
            $table->dateTime('hora_salida')->nullable();
            $table->string('status')->default('1');
            $table->string('img_inicial_1')->nullable();
            $table->string('img_inicial_2')->nullable();
            $table->string('img_inicial_3')->nullable();
            $table->string('img_inicial_4')->nullable();
            $table->string('img_salida_1')->nullable();
            $table->string('img_salida_2')->nullable();
            $table->string('img_salida_3')->nullable();
            $table->string('img_salida_4')->nullable();

            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('set null');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

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
        Schema::dropIfExists('seguimientos');
    }
}
