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
        Schema::create('sucursal', function (Blueprint $table) {
            $table->increments('n_sucursal');
            $table->string('cuit_empresa', 11);
            $table->string('direccion', 50);
            $table->string('nombre', 20);
            
            $table->foreign('cuit_empresa', 'sucursal_ibfk_1')->references('cuit')->on('empresa')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursal');
    }
};
