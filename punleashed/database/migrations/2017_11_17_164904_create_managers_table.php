<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut')->unique();
            $table->string('nombre');

            $table->integer('institucion_id')->unsigned();            
            $table->foreign('institucion_id')
                      ->references('id')->on('institucions')
                      ->onDelete('cascade')->onUpdate('cascade');  

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
        Schema::dropIfExists('managers');
    }
}
