<?php

class Controller extends ExtendController {
  /*
  * Exemplo select
  * $this->_get($table, $where, $order, $return_array, $indice, $final, $field, $group)
  */

  /*
  * @Controller Pagina Inicial
  * @Param $args
  * @return html
  * Route /
  * */

  public function indexAction($args = null) {

    if ($_SERVER['REQUEST_METHOD'] == "POST"):

      //            Captura informações de IP Usuário

      $_POST['ip'] = $_SERVER['REMOTE_ADDR'];
      $_POST['info'] = json_encode(array(
        'ip' => $_SERVER['REMOTE_ADDR'],
        'host' => getHostByAddr($_SERVER['REMOTE_ADDR']),
        'pagina' => '/' . $this->getParentAction(0) . '/' . $this->getParentAction(1),
        'browser' => $_SERVER['HTTP_USER_AGENT'],
        'referer' => $_SERVER['HTTP_REFERER'],
        'id_session_user' => $data['id'],
        'created_at' => date("Y-m-d H:i:s"),
      ));

      $add = $this->ModelClass()->Save($_POST, $_FILES, 'dbo_application_optin', $returnID = true);

      if (is_numeric($add)):
        $this->ModelClass()->sendMessage($_POST);
        $setFlash = array(
          'status' => 'success',
          'title' => 'Sucesso',
          'message' => 'Formulário enviado!',
        );
      else:
        $setFlash = array(
          'status' => 'warning',
          'title' => 'OPS',
          'message' => 'Erro ao cadastrar as informações, tente novamente.',
        );
      endif;

    endif;

    self::Render()->template('index.html.twig', array(
      'templatePath' => isset($args['templatePath']) ? $args['templatePath'] : '',
      'ModuleID' => isset($args['ModuleID']) ? $args['ModuleID'] : '',
      'RefID' => isset($args['RefID']) ? $args['RefID'] : '',
      'Recordset' => isset($Recordset) ? $Recordset : '',
      'setFlash' => isset($setFlash) ? $setFlash : '',
    ));
  }

}

?>
