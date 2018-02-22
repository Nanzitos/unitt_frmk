<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLog extends MyModel
{
    protected $table = 'tipo_log';
    public    $seed  = 'tipo_log';  

    const CREATED_AT = '';
    const UPDATED_AT = '';    

	public function bind($data)
    {   
        
    }

     public function Logs()
    {
        return $this->hasMany('App\Logs', 'id');
    }

}
