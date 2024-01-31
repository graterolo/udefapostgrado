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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 15)->unique();
            $table->string('nombre', 50);
            $table->tinyInteger('sexo');
            $table->string('direc_hab')->nullable();
            $table->string('edo_hab', 30)->nullable();            
            $table->string('ciud_hab', 30)->nullable();
            $table->string('telefono', 25)->nullable();
            $table->string('celular', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
