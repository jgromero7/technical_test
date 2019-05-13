<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('departamento', 50);
            $table->string('localidad', 60);
            $table->string('municipio', 60);
            $table->string('nombre', 75);
            $table->integer('anios_activo');
            $table->string('tipo_persona', 20);
            $table->string('tipo_cargo', 15);
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
        Schema::dropIfExists('dictionary');
    }
}
