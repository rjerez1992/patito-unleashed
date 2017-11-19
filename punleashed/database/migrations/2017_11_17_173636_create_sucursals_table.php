<?php

use App\Constantes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->increments('id');           
            $table->string('nombre')->default(Constantes::NuevaSucursal());
            $table->string('direccion')->default(Constantes::NoEspecificado());
            $table->string('descripcion')->default(Constantes::NoEspecificado());
            $table->string('imagen')->default(Constantes::ImagenDefecto());

            $table->integer('institucion_id')->unsigned();
            $table->foreign('institucion_id')
                      ->references('id')->on('institucions')
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
        Schema::dropIfExists('sucursals');
    }
}
