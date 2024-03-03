<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infoseccion extends Model
{
    use HasFactory;
    protected $fillable = ['plan_id', 'periodo_id', 'nombre', 'docente_id', 'modalidad', 'cupo', 
    'activo', 'created_by', 'updated_by'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function inscripcions()
    {
        return $this->hasMany(Inscripcion::class);
    }
    // Relación con la tabla 'dias'
    public function dias()
    {
        return $this->hasMany(Dia::class);
    }

    // Método para calcular la cantidad de horas académicas entre una hora de entrada y una hora de salida
    public function calcularHorasAcademicas()
    {
        $horasAcademicas = 0;

        foreach ($this->dias as $dia) {
            $horaEntrada = strtotime($dia->hora_ent);
            $horaSalida = strtotime($dia->hora_sal);

            $horasAcademicas += $this->calcularHorasEntreBloques($horaEntrada, $horaSalida);
        }

        return $horasAcademicas;
    }

    // Método para calcular las horas académicas entre bloques de hora
    protected function calcularHorasEntreBloques($horaEntrada, $horaSalida)
    {
        // Obtenemos los bloques de hora definidos en la tabla 'horas'
        $bloquesHora = Hora::all();

        $horasAcademicas = 0;

        foreach ($bloquesHora as $bloque) {
            $horaInicioBloque = strtotime($bloque->he);
            $horaFinBloque = strtotime($bloque->hs);

            // Verificamos si el bloque de hora intersecta con el intervalo de entrada y salida
            if ($horaInicioBloque >= $horaEntrada && $horaFinBloque <= $horaSalida) {
                $horasAcademicas++;
            }
        }

        return $horasAcademicas;
    }
}
