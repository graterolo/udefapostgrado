<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscrito extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'master_id', 'user_id'];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
