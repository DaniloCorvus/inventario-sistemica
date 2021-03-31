<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cliente_id');
            $table->string('num_factura')->nullable();
            $table->string('fecha_compra')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie')->nullable();
            $table->string('imei_uno')->nullable();
            $table->string('imei_dos')->nullable();
            $table->string('procedencia')->nullable();
            $table->string('v_declarado')->nullable();
            $table->string('garantia')->nullable();
            $table->string('referencia')->nullable();
            $table->string('costo_in')->nullable();
            $table->string('costo_out')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('equipos');
    }
}
