<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    //protected $connection = 'general';
    protected $table = 'tesis';
    protected $primaryKey = 'idtesis';
    public $timestamps = false;

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'docente','iddocente','id');
    }
}
