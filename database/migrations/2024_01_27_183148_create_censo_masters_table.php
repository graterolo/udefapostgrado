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
        Schema::create('censo_masters', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 15);
            $table->foreignId('master_id')->constrained('masters')->cascadeOnDelete('restrict');
            $table->date('fecha');
            $table->tinyInteger('validado')->default(0);
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('censo_masters');
    }
};
