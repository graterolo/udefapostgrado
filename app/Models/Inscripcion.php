<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;
    protected $fillable = ['alumno_id', 'infoseccion_id', 'created_by', 'updated_by'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
    public function infoseccion()
    {
        return $this->belongsTo(Infoseccion::class);
    }
    
    
}
