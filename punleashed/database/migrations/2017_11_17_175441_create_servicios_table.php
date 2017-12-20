<?php
use App\Constantes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');         
            $table->string('nombre')->default(Constantes::NoEspecificado());
            $table->string('descripcion')->default(Constantes::NoEspecificado());
            $table->string('letra')->default(Constantes::NoEspecificado());
            $table->string('horario')->default(Constantes::NoEspecificado());
            $table->time('tiempo_espera');
            $table->integer('numero_actual')->default(-1);
            $table->integer('numero_disponible')->default(-1);       

            $table->integer('sucursal_id')->unsigned();
            $table->foreign('sucursal_id')
                      ->references('id')->on('sucursals')
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
        Schema::dropIfExists('servicios');
    }
}
