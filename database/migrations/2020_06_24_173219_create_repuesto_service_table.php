<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestoServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repuesto_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('repuesto_id');
            $table->unsignedInteger('service_id');
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
        Schema::dropIfExists('repuesto_service');
    }
}
