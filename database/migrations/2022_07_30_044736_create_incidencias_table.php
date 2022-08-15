<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('descripcion');
            $table->dateTime('fecha_registrada');
            $table->string('foto_incidencia_1');
            $table->string('foto_incidencia_2');
            $table->string('foto_incidencia_3');

            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('set null');
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('set null');
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
        Schema::dropIfExists('incidencias');
    }
}
