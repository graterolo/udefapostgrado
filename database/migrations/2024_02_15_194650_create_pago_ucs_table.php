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
        Schema::create('pago_ucs', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 15);
            $table->tinyInteger('uc_pagadas');
            $table->tinyInteger('uc_disponibles')->default(0);
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_ucs');
    }
};
