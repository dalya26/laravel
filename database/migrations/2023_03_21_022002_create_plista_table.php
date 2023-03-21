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
        Schema::create('plista', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_alumno');
            $table->boolean('asistio');
            $table->date('fecha');
            $table->timestamps();
            $table->foreign('id_alumno')->references('id')->on('alumno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plista');
    }
};
