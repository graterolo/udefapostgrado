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
        Schema::create('infoseccions', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id')->index();
            $table->integer('periodo_id')->index();
            $table->string('seccion', 9);
            $table->integer('docente_id')->index();
            $table->tinyInteger('modalidad');
            $table->tinyInteger('cupo');
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
        Schema::dropIfExists('infoseccions');
    }
};
