<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('email')->nullable();
            $table->string('identificacion')->unique();
            $table->string('tipo_identificacion');
            $table->string('ciudad')->nullable();
            $table->string('departamento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('barrio')->nullable();
            $table->string('telefono')->nullable();
            $table->string('last')->nullable();
            $table->date('date_last')->nullable();
            $table->string('accept')->nullable();
            $table->string('opcional_telefono')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
