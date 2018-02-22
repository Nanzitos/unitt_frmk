<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Termos;


class TermosController extends Controller
{

	public $t;

	public function getIndex()
    {
			/*
		 * Retorna os registros padrões
		 */
		 
		 
		 
		 if(isset($_GET['filtros'])){			 
		 }

		 //print_r($this->Model); exit;

		 return parent::getIndex();
    }
 
}