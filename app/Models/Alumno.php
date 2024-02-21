<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'nombre1', 'nombre2', 'apellido1', 'apellido2', 'fecha_nac', 
    'sexo', 'direc_hab', 'edo_hab', 'ciud_hab', 'telefono', 'celular', 'titulo', 'user_id'];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function inscripcions()
    {
        return $this->hasMany(Inscripcion::class);
    }
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function getNameAttribute()
    {
        return $this->nombre1.' '.$this->apellido1;
    }

}

