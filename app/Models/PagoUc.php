<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoUc extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'uc_pagadas', 'uc_disponibles', 'fecha'];


}
