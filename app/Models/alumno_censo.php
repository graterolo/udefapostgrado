<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumno_censo extends Model
{
    use HasFactory;
    protected $fillable = ['cedula', 'nombre1', 'nombre2', 'apellido1', 'apellido2', 'fecha_nac', 
    'pais', 'correo', 'sexo', 'direc_hab', 'edo_hab', 'ciud_hab', 'telefono', 
    'celular', 'titulo', 'univ', 'anio_grad', 'postgrado', 'univ_post', 'anio_grad2', 'otros_est', 
    'cargo', 'empresa', 'activ_empresa', 'telefono_emp', 'fax_emp', 'correo_emp', 'dir_emp', 'fecha'];

}
