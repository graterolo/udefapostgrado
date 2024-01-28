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
        Schema::create('alumno_censos', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 15)->unique();
            $table->string('nombre1', 20);
            $table->string('nombre2', 20)->nullable();
            $table->string('apellido1', 20);
            $table->string('apellido2', 20)->nullable();
            $table->date('fecha_nac');
            $table->string('pais', 50)->nullable();
            $table->string('correo', 50);
            $table->tinyInteger('sexo');
            $table->string('direc_hab');
            $table->string('edo_hab', 20);            
            $table->string('ciud_hab', 20);
            $table->string('telefono', 20);
            $table->string('celular', 20)->nullable();
            $table->string('titulo', 30);
            $table->string('univ', 40);
            $table->smallInteger('anio_grad')->nullable();
            $table->string('postgrado', 30)->nullable();
            $table->string('univ_post', 40)->nullable();
            $table->smallInteger('anio_grad2')->nullable();
            $table->string('otros_est', 30)->nullable();
            $table->string('cargo', 40)->nullable();
            $table->string('empresa', 40)->nullable();
            $table->string('activ_empresa', 50)->nullable();
            $table->string('telefono_emp', 20)->nullable();
            $table->string('fax_emp', 20)->nullable();
            $table->string('correo_emp', 50)->nullable();
            $table->string('dir_emp', 200)->nullable();
            $table->date('fecha');
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_censos');
    }
};
