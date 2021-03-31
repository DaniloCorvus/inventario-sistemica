<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('email')->nullable();
            $table->string('identificacion')->unique();
            $table->string('tipo_identificacion');
            $table->string('ciudad');
            $table->string('departamento');
            $table->string('direccion');
            $table->string('barrio')->nullable();
            $table->string('telefono');
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
        Schema::dropIfExists('proveedors');
    }
}
