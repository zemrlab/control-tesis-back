<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //protected $connection = 'general';
    protected $table = 'alumno_programa';
    //protected $primaryKey = 'cod_alumno';
    public $timestamps = false;
}
