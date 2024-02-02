<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 15)->unique();
            $table->string('nombre1', 20);
            $table->string('nombre2', 20)->nullable();
            $table->string('apellido1', 20);
            $table->string('apellido2', 20)->nullable();
            $table->date('fecha_nac');
            $table->tinyInteger('sexo');
            $table->string('direc_hab');
            $table->string('edo_hab', 30);            
            $table->string('ciud_hab', 30);
            $table->string('telefono', 30);
            $table->string('celular', 25)->nullable();
            $table->string('titulo', 50);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
