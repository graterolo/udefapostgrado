<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CensoMaster extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'master_id', 'fecha', 'validado'];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    // Nueva relación para enlazar los datos personales del censo
    public function alumnoCenso()
    {
        return $this->belongsTo(AlumnoCenso::class, 'cedula', 'cedula');
    }

}
