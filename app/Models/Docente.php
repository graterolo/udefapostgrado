<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = ['cedula', 'nombre', 'sexo', 'direc_hab', 'edo_hab', 'ciud_hab', 'telefono', 'celular'];
}
