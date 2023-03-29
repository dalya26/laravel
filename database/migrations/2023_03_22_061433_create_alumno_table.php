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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apetpat');
            $table->string('apetmat');
            $table->string('matricula');
            $table->string('edad');
            $table->string('sexo');
            $table->bigInteger('id_materia')->nullable();
            $table->foreign('id_materia')->references('id')->on('materia');
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
        Schema::dropIfExists('alumno');
    }
};
