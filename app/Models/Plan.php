<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['master_id', 'codigo', 'nombre', 'prelacion1', 'prelacion2', 'semestre', 
    'uc', 'horast', 'horasp', 'created_by', 'updated_by'];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }
}

