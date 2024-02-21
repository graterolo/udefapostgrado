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

}
