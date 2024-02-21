<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $fillable = ['alumno_id', 'plan_id', 'infoseccion_id', 'nota_final', 'created_by', 'updated_by'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
    public function infoseccion()
    {
        return $this->belongsTo(Infoseccion::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
