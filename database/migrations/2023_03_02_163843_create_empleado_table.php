<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cuit_empresa', 11);
            $table->integer('n_sucursal_pertenece')->nullable()->unsigned();
            $table->string('dni', 8);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('direccion', 50);
            $table->string('correo', 50);
            
            $table->foreign('cuit_empresa', 'empleado_ibfk_1')->references('cuit')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('n_sucursal_pertenece', 'empleado_ibfk_2')->references('n_sucursal')->on('sucursal')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
};
