<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    //protected $connection = 'general';
    protected $table = 'docente';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
