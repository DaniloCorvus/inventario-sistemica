<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesorios', function (Blueprint $table) {
            $table->id();
            $table->string('num_parte')->nullable();
            $table->string('num_factura')->nullable();
            $table->string('costo_before_iva')->nullable();
            $table->string('num_pedido')->nullable();
            $table->string('cod_interno')->nullable();
            $table->string('orden_compra')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('fecha_recibido')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('repuesto_id')->nullable();
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
        Schema::dropIfExists('accesorios');
    }
}
