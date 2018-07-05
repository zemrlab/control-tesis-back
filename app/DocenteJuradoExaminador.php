<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocenteJuradoExaminador extends Model
{
    //protected $connection = 'general';
    protected $table = 'docente_jurado_examinador';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
