<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends MyModel
{
    protected $table = 'usuario_logs';
    public    $seed  = 'tipo_log';      
    public    $deletar = true;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'editado_em';    

	public function bind($data)
    {   
        
    }

     public function TipoLog()
    {
        return $this->belongsTo('App\TipoLog', 'id_tipo_log');
    }

    public function Area()
    {
        return $this->belongsTo('App\Areas', 'id_area');
    }

    public function get_tipo_log($obj){
        if(!isset($obj->TipoLog->tipo_log)){
            return '';
        }        
        return $obj->TipoLog->tipo_log;
    }

    public function get_area($obj){        
        if(!isset($obj->Area->titulo)){
            return '';
        }
        return $obj->Area->titulo;
    }

    /**
     * GerarLog
     *
     * Funçao que registra o log de atividade no banco de dados
     * Tipo Operaçao: 1 -> insert, 2 -> update, 3 -> delete
     *
     * @param  object, obj, int, int
     * @return VOID
     */
    public static function gerarLog($user, $area, $tipoOperacao, $idRegistro = "", $dif = ""){

        $idUser = $user->id;
        $nomeUser = $user->nome." ".$user->sobrenome;

        if($tipoOperacao == 1) $tipo = "inseriu um novo registro";
        else if($tipoOperacao == 2) $tipo = "atualizou o registro id '$idRegistro'";        
        else $tipo = "deletou o registro id '$idRegistro'";

        if(is_array($area)){
            if($dif > 0){
                $msgSubArea = "e excluiu";
            }else{
                $msgSubArea = "e adicionou";
            }

            $mensagem = date("d/m/Y H:i:s")." - O usuario <b>".$nomeUser. "(".$idUser.") </b>".$tipo." na area: <b>".$area[0]."</b> ".$msgSubArea." ".abs($dif).
            " registro(s) na subarea <b>".$area[1]."</b>";
        }else{
            $mensagem = date("d/m/Y H:i:s")." - O usuario <b>".$nomeUser. "(".$idUser.") </b>".$tipo." na area: <b>".$area->titulo."</b>";
        }        

        $log = new Logs;
        $log->mensagem = $mensagem;
        $log->id_tipo_log = $tipoOperacao;
        $log->id_area = is_array($area) ? $area[2] : $area->id;            
        $log->save();        

    }
}
