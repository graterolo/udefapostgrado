<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $fillable = ['siglas', 'nombre', 'activo'];

    public function preinscrito()
    {
        return $this->hasMany(Preinscrito::class);
    }
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
