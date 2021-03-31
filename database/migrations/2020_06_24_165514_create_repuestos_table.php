<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('service_id')->nullable();
            $table->unsignedInteger('proveedor_id');
            $table->string('serie')->nullable();
            $table->string('modelo')->nullable();
            $table->string('num_pedido')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('num_factura')->nullable();
            $table->string('fecha_compra')->nullable();
            $table->string('fecha_recibido')->nullable();
            $table->string('fecha_solicitud')->nullable();
            $table->string('guia')->nullable();
            $table->string('orden_compra')->nullable();
            $table->string('cod_interno')->nullable();
            $table->string('delivery_orden')->nullable();
            $table->string('confirmacion')->nullable();
            $table->string('num_parte')->nullable();
            $table->string('valor_before_iva')->nullable();
            $table->string('impuesto')->nullable();
            $table->string('costo_total')->nullable();
            $table->string('costo_in')->nullable();
            $table->string('costo_venta')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('cant_disponible')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('repuestos');
    }
}
