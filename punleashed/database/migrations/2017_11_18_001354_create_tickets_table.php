<?php

use App\Constantes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');         
            $table->date('fecha');
            $table->time('hora');
            $table->integer('numero');
            $table->string('estado')->default(Constantes::NuevoTicket());
           
            $table->integer('servicio_id')->unsigned();
            $table->foreign('servicio_id')
                      ->references('id')->on('servicios')
                      ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                      ->references('id')->on('clientes')
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
        Schema::dropIfExists('tickets');
    }
}
