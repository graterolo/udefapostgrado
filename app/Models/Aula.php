<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'nombre', 'capacidad','created_by', 'updated_by'];

    public function dia()
    {
        return $this->belongsTo(Dia::class);
    }
}

