<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Destinos;


class DestinosController extends Controller
{

	public function getIndex()
    {
			/*
		 * Retorna os registros padrões
		 */
		 $this->Model = Destinos::where('___D_E_L_E_T_E_D___',0)->paginate($this->pagination);
		 
		 if(isset($_GET['filtros'])){			 
		 }

		 //print_r($this->Model); exit;

		 return parent::getIndex();
    }
 
}