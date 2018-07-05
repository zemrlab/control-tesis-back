<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignacionJuradoInformante extends Model
{
    //protected $connection = 'general';
    protected $table = 'designacion_jurado_informante';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
