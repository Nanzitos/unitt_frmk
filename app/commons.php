<?php

class ExtendController extends Influx {
    /*
     * Carrega a Funcão da Classe para ser carregada no Render
     * return @string
     * */

    public $libmodule;

    /*
     * Retorna mensagens de alertas para ser carregada no Render
     * return @string
     * */
    public $setFlash;
    public $t = [];
    public $translate = [];

    //construtor
    // public function __construct() {
    //
    //     parent:: __construct();
    //     $this->setT();
    //     $this->setTranslate();
    // }
    //
    // protected function getLingua(){
    //     if($_SESSION["lang"] == "BR") return 1;
    //     else if($_SESSION["lang"] == "EUA") return 2;
    //     else if($_SESSION["lang"] == "ESP") return 3;
    // }
    //
    //
    // public function setTranslate(){
    //     $lang = $this->getLingua();
    //     $this->translate = $this->_get("termos", "id_lingua = $lang", null, true);
    //     //print_r($this->translate); exit;
    // }
    //
    // public function getTranslate($idRegistro, $idArea){
    //     $termos = [];
    //   //print_r($this->translate); exit;
    //     foreach($this->translate as $key=>$value){
    //         if($value['id_registro'] == $idRegistro && $value["id_area"] == $idArea){
    //             $termos[$value['nome_campo']] = $value["termo"];
    //         }
    //     }
    //    return $termos;
    // }

    public function _get($table = NULL, $where = FALSE, $order = 'id DESC', $return_array = FALSE, $indice = 0, $final = FALSE, $field = NULL, $group = NULL, $deploy = FALSE) {

        if ($table)

        ## LOAD CONTENTS
            $this->select($field)->from($table);

        if ($where):
            $this->where($where);
        endif;

        if ($group):
            $this->groupby($group);
        endif;

        if ($order):
            $this->orderby($order);
        endif;

        if ($final):
            $this->limit($indice, $final);
        endif;


        $this->execute();

        if ($this->check()):
            if ($return_array):
                return $this->data;
            else:
                return $this->data[0];
            endif;
        else:
            if ($deploy)
                echo $this->query;
            else
                return $this->response;
        endif;
    }



    public function setT() {}

    //--------------------------------------------------------------------------------------------------------------------------------
    /* #################################################################################################################### */
    //----------------------------------------------------------------'----------------------------------------------------------------
    public function Controller() {

        /*
         * Variável do Controller
         * return @array
         * */
        $Controller = new Controller();
        return $Controller;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    /* #################################################################################################################### */
    //----------------------------------------------------------------'----------------------------------------------------------------
    public function ModelClass() {

        /*
         * Variável do Model referente ao Controller
         * return @array
         * */
        $ModelClass = new ModelClass();
        return $ModelClass;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    //####################################################################################################################*/
    public function Render() {

        /*
         * Variável do Template
         * return @array
         * */

        $Render = new Render;
        return $Render;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    /* ############################################################################################################################## */
    public function Globals() {

        /*
         * Variável Global
         * return @array
         * */

        $Globals = new Globals();
        return $Globals;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    /* ############################################################################################################################## */
    public function FiltersClass() {

        /*
         * Variável de classes de filtros
         * return @array
         * */

        $FiltersClass = new FiltersClass();
        return $FiltersClass;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    //####################################################################################################################*/
    public function FileHelper() {

        /*
         * Variável Criador de Arquivos
         * return @array
         * */

        $FileHelper = new FileHelper();
        return $FileHelper;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    //####################################################################################################################*/
    public function CalculaDataUtil() {

        $CalculaDataUtil = new CalculaDataUtil();
        return $CalculaDataUtil;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    //####################################################################################################################*/
    public function PrevTempo() {

        $PrevTempo = new PrevTempo();
        return $PrevTempo;
    }

    //PUBLIC FUNCTIONS ###############################################################################################################
    //--------------------------------------------------------------------------------------------------------------------------------
    public function getParentAction($arrPosition = 0) {

        #$arrPosition = isset($arrPosition)?$arrPosition:0;
        $arrPosition = (int) $arrPosition;

        $requestURI = isset($_SERVER['REQUEST_URI']) ? explode('/', $_SERVER['REQUEST_URI']) : NULL;
        $scriptName = isset($_SERVER['SCRIPT_NAME']) ? explode('/', $_SERVER['SCRIPT_NAME']) : NULL;
        for ($i = 0; $i < sizeof($scriptName); $i++) {
            if ($requestURI[$i] == $scriptName[$i]) {
                unset($requestURI[$i]);
            }
        }
        $libmodule = array();
        $libmodule = array_values($requestURI);

        return isset($libmodule[$arrPosition]) ? $libmodule[$arrPosition] : FALSE;
    }

    //--------------------------------------------------------------------------------------------------------------------------------


    public function getGaleria(){
        $this->select('g.id, g.title, g.slug, g.ano, i.legend, i.image')->from('dbo_application_gallery g')->join('dbo_application_gallery_image i', 'i.id_gallery = g.id', 'INNER')->where('`i`.`cover` = 1')->orderBy("intPosition ASC");
        $this->execute();
        return $this->data;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function contador($table = NULL, $where = NULL) {

        ## LOAD CONTENTS
        $this->select()->from($table)
                ->where($where)
                ->execute();

        if ($this->check()):
            return count($this->data);
        endif;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function loadWebApplicationConfig($parameters = null) {

        ## LOAD CONTENTS
        $this->select()->from('dbo_application_settings')
                ->where('id = 1')
                ->execute();
        $this->query;
        if ($this->check()):
            return $this->data[0];
        endif;
    }

    ###################################################################################################

    public function path($args = false) {

        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        unset($scriptName[sizeof($scriptName) - 1]);
        $scriptName = array_values($scriptName);

        return 'http://' . $_SERVER['SERVER_NAME'] . implode('/', $scriptName) . '/' . $args;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function route() {

        $link = "//" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');

        return $escaped_link;
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function arrayToObject($d) {
        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return (object) array_map(__FUNCTION__, $d);
        } else {
            // Return object
            return $d;
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
             * Return array converted to object
             * Using __FUNCTION__ (Magic constant)
             * for recursive call
             */
            return array_map(__FUNCTION__, $d);
        } else {
            // Return array
            return $d;
        }
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function logSystem($data = null) {


        $postfields = array(
            'ip' => $_SERVER['REMOTE_ADDR'],
            'host' => getHostByAddr($_SERVER['REMOTE_ADDR']),
            'pagina' => '/' . $this->getParentAction(0) . '/' . $this->getParentAction(1),
            'browser' => $_SERVER['HTTP_USER_AGENT'],
            'referer' => $_SERVER['HTTP_REFERER'],
            'id_session_user' => $data['id'],
            'created_at' => date("Y-m-d H:i:s"),
        );

        $this->arrayInsert('dbo_application_sessionhandler', $postfields)->execute();
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    public function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"
            return $uuid;
        }
    }

}
