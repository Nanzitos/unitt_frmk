<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends MyModel
{
    protected $table = 'areas';
    public    $seed  = 'titulo';
    public    $deletar = true;
    
    const CREATED_AT = 'criado_em';
	const UPDATED_AT = 'editado_em';

    public function bind($data)
    {
        unset($data['areas/form']);
        if(isset($data['super_admin']) && $data['super_admin'] == 'on'){
            $data['super_admin'] = 1;
        } else {
            $data['super_admin'] = 0;
        }

        return $data;
    }

    public function area_pai()
	{
		return $this->hasOne('App\Areas','id');
	}

	public function areas()
	{
		return $this->hasMany('App\Areas','id_pai');
	}

    public function logs()
    {
        return $this->hasMany('App\Logs','id');
    }

	public function get_id_pai($value)
    {
    	if($value->id_pai){
    		
    		$value = Areas::find($value->id_pai);
            return '<span class="label label-success">'.@$value->titulo.'</span>';

        } else {
            return '<span class="label label-warning">Não possui</span>';
        }

    }
}

