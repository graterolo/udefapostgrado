<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    use HasFactory;
    protected $fillable = ['he', 'hs'];

    protected $casts = [
        'he' => 'datetime:H:i:s',
        'hs' => 'datetime:H:i:s'
    ];
}
