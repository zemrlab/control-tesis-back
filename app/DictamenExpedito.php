<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DictamenExpedito extends Model
{
    //protected $connection = 'general';
    protected $table = 'dictamen_expedito';
    protected $primaryKey = 'iddictamen';
    public $timestamps = false;
}
