<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Logs;

class LogsController extends Controller
{
	public  $index_acoes = false;	

	public function getIndex()
    {   
        /*
        * Retorna os registros padrões
        */
        
        $this->Model = Logs::paginate($this->pagination);
        if(isset($_GET['filtros'])){

            $request       = \Request::all();
            $ids_clientes  = [];

            $this->Model = Logs::where(function($q) use ($request) {

                extract($request);

                if( isset($id_area) && $id_area ){
                    $q->where('id_area', $id_area);   
                }

                if( isset($id_tipo_log) && $id_tipo_log ){
                    $q->where('id_tipo_log',$id_tipo_log);   
                }

            })->paginate($this->pagination);            
        }
        return parent::getIndex();
    }

}