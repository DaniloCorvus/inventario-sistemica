<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('estado_id');
            $table->unsignedInteger('modo_id');
            $table->unsignedInteger('tipo_id');
            $table->unsignedInteger('tipo_reparacion');
            $table->unsignedInteger('razon_id');
            $table->unsignedInteger('equipo_id');
            $table->date('fecha_inicio');
            $table->date('fecha_reparado')->nullable();
            $table->date('fecha_finalizado')->nullable();
            $table->date('fecha_autorizado')->nullable();
            $table->date('fecha_promesa')->nullable();
            $table->string('valor_obra')->nullable();
            $table->string('valor_aprobado')->nullable();
            $table->string('happycall_estado')->nullable();
            $table->string('happycall_calificacion')->nullable();
            $table->string('valor_cotizado')->nullable();
            $table->string('valor_total')->nullable();
            $table->string('valor_cargo_fabrica')->nullable();
            $table->string('valor_cargo_cliente')->nullable();
            $table->string('valor_adicionales')->nullable();
            $table->string('valor_gastos')->nullable();
            $table->string('factura')->nullable();
            $table->string('valor_repuestos')->nullable();
            $table->string('accesorio_equipo')->nullable();
            $table->longText('observacion_happycallestado')->nullable();
            $table->longText('observacion')->nullable();
            $table->longText('reporte')->nullable();
            $table->string('radicado')->nullable();
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
        Schema::dropIfExists('services');
    }
}
