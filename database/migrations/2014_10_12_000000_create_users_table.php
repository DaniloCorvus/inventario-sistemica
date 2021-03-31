<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identificacion');
            $table->string('estado')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tipo_contrato')->nullable();
            $table->string('porcentual_home')->nullable();
            $table->string('porcentual_taller')->nullable();
            $table->string('eps')->nullable();
            $table->string('arl')->nullable();
            $table->string('ccf')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->date('fecha_c')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_retiro')->nullable();
            $table->string('company')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
