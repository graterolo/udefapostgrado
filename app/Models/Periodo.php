<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'fecha_ini', 'fecha_fin', 'activo', 'created_by', 'updated_by'];


    public function infoseccions()
    {
        return $this->hasMany(Infoseccion::class);
    }
}
