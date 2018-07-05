<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignacionJuradoExaminador extends Model
{
    //protected $connection = 'general';
    protected $table = 'designacion_jurado_examinador';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
