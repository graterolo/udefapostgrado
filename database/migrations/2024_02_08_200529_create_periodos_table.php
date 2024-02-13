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
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 6)->unique();
            $table->date('fecha_ini');
            $table->date('fecha_fin'); 
            $table->tinyInteger('activo')->default(0);           
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodos');
    }
};
