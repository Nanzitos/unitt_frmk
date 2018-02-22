<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Termos extends MyModel
{
    protected $table = 'termos';
    public    $seed  = 'termos';
    public    $deletar = true;
    
    const CREATED_AT = null;
	const UPDATED_AT = null;

    public function bind($data)
    {       
        return $data;
    }

  
}

