<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;
    protected $fillable = ['infoseccion_id', 'ndia', 'hora_ent', 'hora_sal', 'aula_id','created_by', 'updated_by'];

    protected $casts = [
        'hora_ent' => 'datetime:H:i:s',
        'hora_sal' => 'datetime:H:i:s'
    ];
    

    public function infoseccion()
    {
        return $this->belongsTo(Infoseccion::class);
    }

}


