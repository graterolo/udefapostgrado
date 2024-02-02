<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master extends Model
{
    use HasFactory;
    protected $fillable = ['siglas', 'nombre', 'activo'];

    public function preinscrito()
    {
        return $this->hasMany(Preinscrito::class);
    }
}
