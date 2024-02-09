<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $fillable = ['nperiodo', 'fecha_ini', 'fecha_fin', 'activo', 'created_by', 'updated_by'];

}
