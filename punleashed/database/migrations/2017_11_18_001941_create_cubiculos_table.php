<?php

use App\Constantes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cubiculos', function (Blueprint $table) {
            $table->increments('id');         
            $table->string('nombre')->default(Constantes::NuevoCubiculo());
            $table->integer('numero_atencion')->default(-1);
            $table->string('disponibilidad')->default(Constantes::CubiculoVacio());
           
            $table->integer('servicio_id')->unsigned();
            $table->foreign('servicio_id')
                      ->references('id')->on('servicios')
                      ->onDelete('cascade')->onUpdate('cascade'); 

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
        Schema::dropIfExists('cubiculos');
    }
}
