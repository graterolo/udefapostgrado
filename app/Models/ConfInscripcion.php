<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfInscripcion extends Model
{
    use HasFactory;
    protected $fillable = ['periodo_id', 'fecha_ini', 'fecha_fin', 'created_by', 'updated_by'];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
}

