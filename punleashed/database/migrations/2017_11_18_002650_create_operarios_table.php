<?php

use App\Constantes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operarios', function (Blueprint $table) {
            $table->increments('id');         
            $table->string('rut')->unique();
            $table->string('nombre')->default(Constantes::NoEspecificado());
            $table->string('imagen')->default(Constantes::ImagenDefecto());

            $table->integer('cuenta_id')->unsigned();    
            $table->foreign('cuenta_id')
                      ->references('id')->on('cuentas')
                      ->onDelete('cascade')->onUpdate('cascade');  
           
            $table->integer('cubiculo_id')->unsigned()->nullable();;
            $table->foreign('cubiculo_id')
                      ->references('id')->on('cubiculos')
                      ->onDelete('cascade')->onUpdate('cascade'); 

            $table->integer('servicio_id')->unsigned()->nullable();;
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
        Schema::dropIfExists('operarios');
    }
}
