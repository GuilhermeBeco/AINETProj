<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
   protected $table = 'aeronaves';
   protected $fillable = [
        'matricula', 'modelo', 'marca', 'conta_horas', 'num_lugares', 'prec_hora', 
    ];
    
}
