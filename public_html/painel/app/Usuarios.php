<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends MyModel
{
    protected $table = 'usuarios';
    public    $seed  = 'nome|sobrenome';
    public    $deletar = true;

    const CREATED_AT = 'criado_em';
	const UPDATED_AT = 'editado_em';

    public function bind($data)
	{
		if(isset($data['password']) && $data['password']){
			$data['password'] = \Hash::make($data['password']);
		} else {
            unset($data['password']);
        }

		if(isset($data['superadmin']) && $data['superadmin'] == 'on'){
			$data['superadmin'] = 1;
		} else {
			$data['superadmin'] = 0;
		}

        if(isset($data['is_televendas']) && $data['is_televendas'] == 'on'){
            $data['is_televendas'] = 1;
        } else {
            $data['is_televendas'] = 0;
        }

        if(isset($data['is_backoffice']) && $data['is_backoffice'] == 'on'){
            $data['is_backoffice'] = 1;
        } else {
            $data['is_backoffice'] = 0;
        }

        if( isset($data['AreasPermissoes']) && $data['AreasPermissoes'] )
        {
            $data['areas_permissoes'] = implode(',', $data['AreasPermissoes']);
            unset($data['AreasPermissoes']);
        }

        if( isset($data['TasksPermissoes']) && $data['TasksPermissoes'] ){

            $data['tasks_permissoes'] = implode(',', $data['TasksPermissoes']);
            unset($data['TasksPermissoes']);

        }

		return $data;
	}

    public function tasks()
    {
        return $this->hasMany('App\Tasks', 'id_redator');
    }

    public function grupo()
    {
        return $this->belongsTo('App\GruposUsuarios','id_grupo');
    }

    public function get_id_grupo($obj)
    {
        @$nome = $obj->grupo->nome;
    	return '<span class="label label-warning">'.$nome.'</span>';
    }

    public function get_superadmin($obj)
    {
    	if($obj->superadmin){
            return '<span class="label label-success">Sim</span>';
        } else {
            return '<span class="label label-danger">Não</span>';
        }
    }

    public function aph_canvas()
    {
        return $this->hasMany('App\AphroditeCanvas', 'editado_por');
    }
}
