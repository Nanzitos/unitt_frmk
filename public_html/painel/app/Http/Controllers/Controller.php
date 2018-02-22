<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use App\Areas;
use App\Empresas;
use App\Logs;
use App\Termos;
use App\Linguas;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $view = '';
    public $Area = [];
    public $ModelString = '';
    public $Model = [];
    public $OverwriteModel = [];
    public $pagination = 20;
    public $index_acoes = true;
    public $novo_registro = true;
    public $botaoVisualizar = false;

    public function __construct() {

        /*
         * Define as uris que podem acessar ignorando as regras de login
         */

        $ExternalAccess = ['painel'];


        $segments = explode('/', $_SERVER['REQUEST_URI']);

        $uri = parse_url($segments[3])['path'];

        ///     echo $uri; exit;
        if (!in_array($uri, $ExternalAccess)) {

            if (!\Auth::check()) {

                //Verifica se o acesso Ã© pelo login
                if ($segments[3] != 'login' && !\Request::isMethod('post')) {

                    if (\Request::ajax()) {
                        return response()->json(['response' => false]);
                    } else {
                        // echo 1; exit;
                        header('Location: /painel/public/login');
                        exit;
                    }
                }
            } else {

                if ($segments[3] == 'login') {
                    header('Location: /dashboard');
                }
            }
        }

        /**
         * Define a area solicitada
         *
         */
        if (!$this->Area)
            $this->setArea($uri);

        /*
         * Verifica a permissÃ£o do usuÃ¡rio
         */
        if (!\Auth::guest()) {

            $AreasPermissoes = explode(',', \Auth::user()->areas_permissoes);

            if (!is_null($this->Area) && !in_array($this->Area->id, $AreasPermissoes) && !\Auth::user()->superadmin) {
                abort(403);
            }
        }


        /**
         * Define os valores do model
         *
         */

      //  echo $uri; exit;
        $this->setModel($uri);
    }

    /**
     * Index
     *
     * Quando utilizada pelo controller principal, carrega as informaÃ§Ãµes
     * de listagem do Ã¡rea escolhida ou html personalizado de acordo com
     * a necessidade do projeto. PoderÃ¡ ser sobreescrita no controller referente.
     *
     * OBS: o prefixo get no nome da funÃ§Ã£o Ã© uma exigÃªncia do framework
     *
     * @param  null
     * @return view
     */
    public function getIndex() {
        $view = 'layouts.default.index';

        if ($this->view)
            $view = $this->view;
          
        return view($view)
                        ->with('Area', $this->Area)
                        ->with('Model', $this->Model)
                        ->with('ConfigFile', $this->getConfigFile())
                        ->with('Controller', $this)
                        ->with('title', $this->Area->titulo);
    }

    /**
     * Delete
     *
     * FunÃ§Ã£o que deleta registros baseado id enviado pela URL
     *
     * OBS: o prefixo get no nome da funÃ§Ã£o Ã© uma exigÃªncia do framework
     *
     * @param  string
     * @return boolean
     */
    public function getDelete($id) {
        if ($id) {

            $Model = $this->Area->controller;
            $Model = app("App\\$Model")->find($id);

            if ($Model->deletar == false) {

                $Model->excluido = 1;
                $Model->excluido_em = date("Y-m-d H:i:s");
                $Model->excluido_por = \Auth::user()->id;
                $Model->save();
            } else
                $delete = $Model->find($id)->delete();

            //Gravo a exclusao no log
            Logs::gerarLog(\Auth::user(), $this->Area, 3, $id);
        }
        return redirect(url($this->Area->url));
        //return redirect(url($this->Area->url.'?d='.$delete));
    }

    /**
     * Form
     *
     * FunÃ§Ã£o que adiciona ou edita registros dependendo do
     * parametro enviado na URL ou nÃ£o.
     *
     * OBS: o prefixo get no nome da funÃ§Ã£o Ã© uma exigÃªncia do framework
     *
     * @param  int
     * @return view
     */
    public function getForm($id = false) {
        //print_r($this->Area); exit;
        $Model = $this->Area->controller;
        $Model = app("App\\$Model");

      //  echo $Model; exit;

        if (\Request::isMethod('post')) {
            $request = \Request::all();
            foreach($request as $key=>$valor){
                if(strpos($key, "/form") !== false){
                    unset($request[$key]);
                }
            } 
                
            $Model = $this->save($Model, $request);

            if (isset($Model->return)) {
                return $Model;
            }

            //return redirect(url($this->Area->url.'/form/'.$Model->id));
            //echo url($this->Area->url);
            return redirect(url($this->Area->url));
        } else {

            if ($id) {
               // print_r($Model); exit;
                $Model = $Model::where($Model->pk, $id)->first();
               // print_r($Model); exit;
                $this->Model = $Model;
            }
        }

        if ($id && !$Model) {
            return response()->view('errors.404', [], 404);
        }

        return view('layouts.default.form')
                        ->with('Area', $this->Area)
                        ->with('Model', $Model)
                        ->with('ConfigFile', $this->getConfigFile())
                        ->with('title', $this->Area->titulo);
    }

    /**
     * save
     *
     * FunÃ§Ã£o que executa a requisição POST de um formulÃ¡rio
     *
     *
     * @param  object, obj
     * @return int
     */
    public function save($Model, $data) {

        if (method_exists($Model, 'bind')) {
            $data = $Model->bind($data);

            if (!$data) {
                return $Model;
            }
        }

        unset($data['_token']);

        if (isset($data['id']) && $data['id']) {
            //Registro essa ediçao no log
            Logs::gerarLog(\Auth::user(), $this->Area, 2, $data['id']);
            $Model = $Model->find($data['id']);
        } else {
            //Registro essa inserçao no log
            Logs::gerarLog(\Auth::user(), $this->Area, 1);
        }

        if (isset($data['ativo'])) {
            if ($data['ativo'] == 'on') {
                $data['ativo'] = 1;
            }
        } else {

            if (isset($Model->ativo))
                $data['ativo'] = 0;
        }

        foreach ($data AS $key => $val) {
            if (!is_array($val)) {
                $Model->$key = utf8_decode($val);
            }
        }

        //dd($Model);

        $Model->save();

         if(isset($Model->multi)){          
            foreach($data as $key=>$val){
                if(in_array($key, $Model->multi)){
                    $Termo = Termos::where("id_lingua", 1)
                                    ->where("id_registro", $Model->id)
                                    ->where("nome_campo", $key)
                                    ->where("id_area", $this->Area->id)
                                    ->first();

                    if(count($Termo) < 1) $Termo = new Termos;
                    
                    $Termo->id_lingua = 1;
                    $Termo->id_registro = $Model->id;
                    $Termo->nome_campo = $key;
                    $Termo->termo = $val;
                    $Termo->id_area = $this->Area->id;
                    $Termo->save();
                }
            }
        }

        /*
         * Executa uma funÃ§Ã£o com o
         * retorno do objeto inserido
         */
        if (method_exists($Model, 'afterSave')) {
            $Model->afterSave($Model, $data);
        }

        return $Model;
    }

    /**
     * setArea
     *
     * Define a area solicitada
     *
     * @param string
     * @return boolean
     */
    private function setArea($uri) {
        return $this->Area = Areas::where('url', $uri)->first();
    }

    /**
     * setModel
     *
     * Define a quais valores o controller deverÃ¡ olhar
     *
     * @param null
     * @return boolean
     */
    public function setModel() {

        if (count($this->Model))
            return true;

        if (!$this->Area) {
            return [];
        }

       // print_r($this->Area); exit;

        $Model = $this->Area->controller;

        

        if (!class_exists("App\\$Model")) {
            $this->Model = new \StdClass();
            return true;
        }

        $Model = app("App\\$Model");


        $excluido = '';


        if (isset($Model->orderListBy) && is_array($Model->orderListBy)) {
            $this->Model = $Model->orderBy($Model->orderListBy[0], $Model->orderListBy[1])->paginate($this->pagination);
        } else {
            $this->Model = $Model->paginate($this->pagination);
        }
    }

    /**
     * getConfigFile
     *
     * Captura o arquivo json de configuração baseado na pasta da view e arquivo
     * e hidrata a variÃ¡vel caso o arquivo exista.
     *
     * @param  boolean
     * @return array
     */
    public static function getConfigFile($return_json = false) {
        $json = '';
        $MethodName = explode('@', \Route::currentRouteAction());
        $ViewFolderName = explode("\\", $MethodName[0]);
        $ViewFolderName = strtolower(str_replace('Controller', '', $ViewFolderName[3]));
        $viewPath = \Config::get('view.paths')[0];

        if (!isset($MethodName[1]) || !file_exists($viewPath . '/' . $ViewFolderName . '/config.json')) {
            var_dump(file_exists($viewPath . '/' . $ViewFolderName . '/config.json'));
            exit;
            return array();
        }

        $MethodName = strtolower(str_replace('get', '', $MethodName[1]));
        $JsonFile = file_get_contents($viewPath . '/' . $ViewFolderName . '/config.json');
        $json = json_decode($JsonFile, true);

        if (!$json) {
            exit(utf8_decode('Ops! Arquivo de configuração inválido ou inexistente.'));
        }

        if (!isset($json[$MethodName]))
            return null;

        if ($return_json) {
            echo json_encode($json[$MethodName]);
            return false;
        } else {
            $json = $json[$MethodName];
        }

        return $json;
    }

    public static function getTranslate(){

        $arrCampos = [];        
        $Area = Areas::find($_POST['area']);
        $Lingua = Linguas::where('sigla',$_POST['lingua'])->first();
        $idRegistro = $_POST['id_registro'];
        $pathName = $Area->controller;
        $Model = app("App\\$pathName");     

        $json = '';
       // $MethodName = explode('@', \Route::currentRouteAction());
      //  $ViewFolderName = explode("\\", $MethodName[0]);
        $ViewFolderName = strtolower($Area->controller);
        $viewPath = \Config::get('view.paths')[0];
        
        if (!file_exists($viewPath . '/' . $ViewFolderName . '/config.json')) {
            var_dump(file_exists($viewPath . '/' . $ViewFolderName . '/config.json'));
            exit;
            return array();
        }

       // $MethodName = strtolower(str_replace('get', '', $MethodName[1]));
        $JsonFile = file_get_contents($viewPath . '/' . $ViewFolderName . '/config.json');
        $json = json_decode($JsonFile, true);

        foreach ($json['form']['fields'] as $key => $value){
            if(isset($value['multi'])){               
                $Termos = Termos::where(array("id_lingua" => $Lingua->id, "id_area" => $Area->id, "nome_campo" => $value["name"], "id_registro" => $idRegistro))->first(); 
                $arrCampos[$value["name"]] = !empty($Termos) ? $Termos->termo : 0;
            }
        }
        echo json_encode($arrCampos);
        exit;
    }

    public function saveTranslate(){

        extract($_POST);

        $campos = json_decode($campos, true);
        $valores = json_decode($valores, true);

        $Lingua = Linguas::where('sigla', $lingua)->first();

        $arrValores = array_combine($campos, $valores);
        
        foreach($arrValores as $key=>$value){

            $Termos = Termos::where(array("id_lingua" => $Lingua->id, "id_area" => $area, "nome_campo" => $key, "id_registro" => $id_registro))->first(); 
          
            if(count($Termos) < 1){
                 $Termos = new Termos();
            }

           
            $Termos->id_area = $area;
            $Termos->id_registro = $id_registro;
            $Termos->id_lingua = $Lingua->id;
            $Termos->nome_campo = $key;
            $Termos->termo = $value;
            $Termos->save();
        }

        echo json_encode(["response" => true]);
    }

    public function searchUrl($term) {
        if (strpos($_SERVER['REQUEST_URI'], $term) === false) {
            return false;
        } else {
            return true;
        }
    }

}
