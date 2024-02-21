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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_id')->constrained('masters')->cascadeOnDelete('restrict');
            $table->string('codigo', 6)->unique();
            $table->string('nombre', 100);
            $table->string('prelacion1', 6)->nullable();
            $table->string('prelacion2', 6)->nullable();
            $table->tinyInteger('semestre');
            $table->tinyInteger('uc');
            $table->mediumInteger('horast')->nullable()->default(0);
            $table->mediumInteger('horasp')->nullable()->default(0);
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
        Schema::dropIfExists('plans');
    }
};
