<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infoseccion extends Model
{
    use HasFactory;
    protected $fillable = ['plan_id', 'periodo_id', 'seccion', 'docente_id', 'modalidad', 'cupo', 
    'activo', 'created_by', 'updated_by'];
}
