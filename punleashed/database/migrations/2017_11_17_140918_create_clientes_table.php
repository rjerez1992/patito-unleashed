<?php

use App\Constantes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut')->unique();
            $table->string('nombre');
            $table->string('direccion')->default(Constantes::NoEspecificado());
            $table->string('imagen')->default(Constantes::ImagenDefecto());
            $table->integer('max_tickets')->default(Constantes::MaxTickets());            
            $table->integer('cuenta_id')->unsigned();          
            $table->foreign('cuenta_id')
                      ->references('id')->on('cuentas')
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
        Schema::dropIfExists('clientes');
    }
}
