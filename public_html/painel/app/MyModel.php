<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{   
    public $btn_deletar      = true;
    public $btn_editar       = true;
    public $send_form_button = true;
    public $pk               = 'id';
    public $deletar          = true;

    
    const CREATED_AT    = 'criado_em';
   // const UPDATED_AT    = 'editado_em';

	/**
     * get_ativo
     *
     * Retorna para listagem o valor de ativo quando setado no arquivo de config.json
     *
     * @param  null
     * @return html/string
     */


	public function get_ativo($value)
    {
        if($value->ativo){
            return '<span class="label label-success">Ativo</span>';
        } else {
            return '<span class="label label-warning">Inativo</span>';
        }
    }

    public function get_criado_em($obj)
    {
        return date('d/m/Y H:i:s', strtotime($obj->criado_em));
    }

    /**
     * saveMany
     *
     * Função dinamica que trata o save dos dados many to many.
     * Deve sempre ser chamada no BIND do model.
     *
     * @param  null
     * @return html/string
     */

	public function saveMany($data, $fk, $ParentModel, $RelatedModelParam, $related_model_id, $delete=true)
	{	

		$ParentModel  = app("App\\$ParentModel"); //Cria instancia do model pai
		$RelatedModel = app("App\\$RelatedModelParam"); //Cria instancia do model relacionado

        //Faço a chamada da função que irá registrar os logs
        $this->registerManyLogs($data, $RelatedModel, $fk, $related_model_id, $ParentModel); 
        
        if($delete){
            $RelatedModel::where(array($fk => $related_model_id))->delete(); //deleta todos os registros relacionados com o pai
        }
    	
		$seed = $RelatedModel->seed;       

        foreach($data AS $key => $val){

            if( isset($val[$seed]) && $val[$seed] ){ //Se não for setado o valor do seed, não tem porque salvar a relação.

                $val[$fk] = $related_model_id;

                $RelatedModel = app("App\\$RelatedModelParam");

                foreach($val AS $field => $value){
                    if($value !== null){
						$RelatedModel->$field = $value;	
					}
				}                
                $RelatedModel->save();
			}
		}

		return true;
	}

    /**
    *   Função que registra os logs quando a tipo de relacionamento da dado é de many to many   
    *
    */

    public function registerManyLogs($data, $RelatedModel, $fk, $related_model_id, $ParentModel){

        $arrayCompara = array();        
        $dif = array();

        $registrosAtuais = $RelatedModel::where(array($fk => $related_model_id, ))->get();  

        foreach($registrosAtuais as $registro){
            $arrayCompara[] = $registro;
        }

        foreach($data as $key=>$value){
            if(empty($value["id_produto"])){
                unset($data[$key]);
            }
        }

        if(count($arrayCompara) != count($data)){
            $dif = (count($arrayCompara) - count($data));
        }else $dif = false;       
        
        $area = Areas::where("titulo", $ParentModel->table)->get();
        
        if(!count($area)){
             $area = Areas::where("subtitulo", $ParentModel->table)->get();
        }

        $areas[] = $ParentModel->table;
        $areas[] = $RelatedModel->table;
        $areas[] = $area[0]->id;       

        if($dif){
            //Registro essa ediçao no log
            Logs::gerarLog(\Auth::user(), $areas, 2, $related_model_id, $dif);
        }

        
    }

    public function dateToDb($data){
        return implode('-', array_reverse(explode('/', $data)));
    }

    public function pk()
    {   
        $id = $this->pk;

        return $this->$id;
    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

}