<?php

class Autoloader {

  public $controllerFile;

  public $libmodule;

  public $IDController;

  public $checkRoute;

  public $ObjController = array();

  /*
  * RENDER ERROR
  */
  public function Render() {

    /*
    * Variável do Template
    * return @array
    * */

    $Render = new Render;
    return $Render;
  }

  private function clearNameSpacetoController($args = false) {

    // $args = $_SERVER['QUERY_STRING'];

    if ($args):
      $args = str_replace("-", "", $args);
      $args = str_replace("_", "", $args);
      $args = trim($args);
      return $args;
    endif;
  }

  //################################################################################################################################
  //--------------------------------------------------------------------------------------------------------------------------------
  function getScriptUrl($args = false) {

    $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
    unset($scriptName[sizeof($scriptName) - 1]);
    $scriptName = array_values($scriptName);
    return 'http://' . $_SERVER['SERVER_NAME'] . implode('/', $scriptName) . '/' . $args;
  }

  ///################################################################################################################################
  //--------------------------------------------------------------------------------------------------------------------------------
  function read_path() {

    $requestURI = explode('/', $_SERVER['REQUEST_URI']);
    $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
    for ($i = 0; $i < sizeof($scriptName); $i++) {
      if ($requestURI[$i] == $scriptName[$i]) {
        unset($requestURI[$i]);
      }
    }
    $libmodule = array_values($requestURI);

    if (empty($libmodule[0])):
      $returnPath = __mainPath__;

    else:
      $returnPath = $libmodule[0];

    endif;

    return $returnPath;
  }

  //################################################################################################################################
  //--------------------------------------------------------------------------------------------------------------------------------
  function loaderController() {

    $libmodule = $this->libmodule;

    if (is_callable(array('Controller', $libmodule))):

      try {

        $Controller = new Controller();
        print $Controller->$libmodule(
          array(
            'templatePath' => $this->controllerFile[1],
            'ModuleID' => $this->IDController,
            'broken_main' => substr($_SERVER['REQUEST_URI'], 1),
          )
        );

      } catch (Exception $e) {

        var_dump($e->getMessage());
      }

    else:

      echo "Error - Impossível carregar o módulo. <br />";
      echo "Verifique se a funcão " . $libmodule . " existe.";

    endif;
  }

  //################################################################################################################################
  //--------------------------------------------------------------------------------------------------------------------------------
  function loadModule($parameters = false) {

    $args = array();

    $ObjController = array();

    $__router__ = spyc_load_file(___ROUTING_YML___);
    $selfPath = $this->clearNameSpacetoController($this->read_path());
    $paramPath = explode('?', $selfPath);
    //Regra para parametro vindo como http://www.vagasinclusivas.com.br/vi0000

    if (preg_replace("/[0-9]/", "", $paramPath[0]) === 'vi'):

      $selfPath = 'busca';
      $this->controllerFile = array(0 => 'Bundles', 1 => 'Busca', 2 => 'detalhe');

      $this->ObjController = $__router__[___Bundle___][$selfPath];


    else:

      if ($selfPath == __mainPath__):
        $selfPath = "/";
      else:
        $selfPath = "/" . $selfPath;
      endif;

      $this->ObjController = $__router__[___Bundle___][$selfPath];


      $this->controllerFile = explode(":", $this->ObjController["_controller"][0]);
      $this->IDController = isset($this->ObjController["id"][0]) ? $this->ObjController["id"][0] : NULL;


    endif;

    /* if($this->IDController != 0):

    $Globals->securityAccess();

    if (!in_array($this->IDController, json_decode($_SESSION["__SESSION_AUTHENTICATE_USERDATA"]['access_overriding_module']))):
    $this->Render()->template('no_access.html.twig', $args['templatePath']);
    break;
  endif;


endif; */

if (!empty($this->controllerFile[0])):


  $setModel = new SplFileInfo('../src/' . $this->controllerFile[0] . '/Modules/' . $this->controllerFile[1] . '/Model/' . $this->controllerFile[1] . 'ModelClass.php');
  include($setModel->getRealPath());

  $setController = new SplFileInfo('../src/' . $this->controllerFile[0] . '/Modules/' . $this->controllerFile[1] . '/Controller/' . $this->controllerFile[1] . 'Controller.php');
  include($setController->getRealPath());

  #Doctrine_Core::loadModels('src/'.$this->controllerFile[0].'/Modules/'.$this->controllerFile[1].'/Entity/'.$this->controllerFile[1].'Entity.php');

  $this->libmodule = $this->controllerFile[2] . 'Action';


  try {

    $this->loaderController();
  } catch (Exception $e) {
    var_dump($e->getMessage());
  }


else:

  $this->Render()->template('404.html.twig', $args['templatePath']);

endif;
}

//################################################################################################################################
//--------------------------------------------------------------------------------------------------------------------------------
}

?>
