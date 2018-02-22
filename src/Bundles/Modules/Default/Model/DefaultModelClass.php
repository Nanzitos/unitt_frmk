<?php

class ModelClass extends ExtendController {

  /**
  * Armazena url de retorno
  * @var sha1
  */
  public $fromsite;

  /**
  * Armazena password para tratamento
  * @var sha1
  */
  #public $password = '';

  /**
  * Armazena password para tratamento
  * @var base64
  */
  #public $salt = '';

  /**
  * Armazena o nome do arquivo
  * @var string
  */
  public $filename;

  /**
  * Armazena o caminho do arquivo
  * @var string
  */
  public $pathname;

  /**
  * Retorna bool do upload de arquivo
  * @var bool
  */
  public $upstatus;

  /**
  * Retorna string do upload de arquivo
  * @var string
  */
  public $uperror;

  /**
  * Retorna array para insert data
  * @var string
  */
  public $postfields = array();

  /*     * bio
  @Model
  @data $POST, $FILE
  @table $TABLE
  @return Bool / int
  */

  public function Save($POST = NULL, $FILE = NULL, $TABLE = NULL, $returnID = true) {

    #check upload file and add values to insert data
    if (isset($FILE['FileInput']['name']) && $FILE['FileInput']['error'] == 0):

      $this->thisUploadPNGImage($FILE['FileInput']);
      $POST['picture'] = $FILE['FileInput']['name'] ? $this->pathname . $this->filename : $POST['picture_tmp_name'];

    endif;


    $this->postfields['created_at'] = date('Y-m-d H:i');


    #get columns name from table and search recursive update values.
    $this->showcol()->from($TABLE)->execute();

    foreach ($this->data as $key => $value) {
      foreach ($value as $skey => $svalue) {
        if ($skey == 'Field')
        if (isset($POST[$svalue]) || !empty($POST[$svalue]))
        $this->postfields[$svalue] = $this->getFilter($svalue, $POST[$svalue]);
      }
    }

    $id = isset($POST['id']) ? $POST['id'] : NULL;

    $this->select()
    ->from($TABLE)
    ->where("id = '" . $id . "' ")
    ->execute();


    if ($this->check()):

      try {
        $this->arrayUpdate($TABLE, $this->postfields, "id = '" . $id . "' ")->execute();
        if ($returnID):
          return $id;
        else:
          return true;
        endif;
      } catch (Exception $e) {
        return false;
        die('ERROR: ' . $e->getMessage());
      }

    else:


      try {
        $this->arrayInsert($TABLE, $this->postfields)->execute();
        if ($returnID):
          return $this->lastInsertID();
        else:
          return true;
        endif;
      } catch (Exception $e) {
        return false;
        die('ERROR: ' . $e->getMessage());
      }

    endif;

    return false;
  }

  /**
  @Model
  @data $value
  @type $typeof
  @return String
  */
  public function getFilter($typeof = null, $value = null) {

    switch ($typeof) {
      case 'dt_envio':
      case 'dt_entrega_v1':
      return FiltersClass::gravaData($value);
      break;
      case 'password':
      if ($value)
      return sha1($value);
      break;
      case 'valor_custo':
      #$array = array_map('htmlentities',$value);
      #$json = html_entity_decode(json_encode($array));
      return FiltersClass::formatMoney($value);
      break;
      case 'bio':
      return mysql_real_escape_string($value);
      break;
      default:
      return mysql_real_escape_string($value);
      break;
    }
  }

  /**
  @Model
  @data $paramform, $paramfile
  @return Bool
  */
  //--------------------------------------------------------------------------------------------------------------------------------

  public function sendMessage($paramForm = NULL, $paramFile = NULL) {

    $mail = new PHPMailer();

    // Define os dados do servidor e tipo de conexão
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP();
    $mail->Host = SmtpServer;
    $mail->SMTPAuth = (AuthServer == 1) ? true : false;
    $mail->Username = AccoServer;
    $mail->Password = PassServer;
    $mail->Port = 587;
    $mail->isSMTP();
    $mail->SMTPDebug = 1;
    $mail->SMTPSecure = "tls";

    // Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = AccoServer;
    $mail->FromName = 'ICTS - Pró Ética';

    // Define os destinatário(s)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress('web@icts.com.br', 'Contato Site - ICTS Pró Ética');
    $mail->AddBCC('developer@unitta.com.br', 'Contato Site - ICTS Pró Ética');
    $mail->AddBCC('contato@protiviti.com.br', 'Contato Site - ICTS Pró Ética');


    // Reply-To
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddReplyTo($paramForm['email'], 'ICTS Pró Ética');

    // Define os dados técnicos da Mensagem
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';

    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = "Contato Site - ICTS Pró Ética";

    $mail->Body = '
    <!DOCTYPE html>
    <html dir="ltr" lang="pt-br">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    </head>

    <body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <table width="100%" border="0" cellspacing="10" cellpadding="10">
    <tr>
    <td align="left" valign="top" colspan="2" bgcolor="#dddddd"><font face="verdana"><h2>Formulário de Contato<h2></font></td>
    </tr>';
    if (isset($paramForm['nome'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">Nome:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['nome'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['email'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">E-mail:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['email'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['telefone'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">Telefone:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['telefone'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['cidade'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">Cidade:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['cidade'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['estado'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">UF:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['estado'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['empresa'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">Empresa:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['empresa'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['assunto'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">Assunto:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['assunto'] . '</font></td>
      </tr>';
    endif;

    if (isset($paramForm['mensagem'])):
      $mail->Body = $mail->Body . ' <tr>
      <td align="right" valign="top" bgcolor="#dddddd" width="10%"><font face="verdana">Mensagem:</font></td>
      <td align="left" valign="top" bgcolor="#dddddd"><font face="verdana">' . $paramForm['mensagem'] . '</font></td>
      </tr>';
    endif;

    $mail->Body = $mail->Body . '<tr>
    <td align="center" valign="top" colspan="2" bgcolor="#dddddd"><font face="verdana" size="1"></td>
    </tr>
    </table>
    </body>
    </html>';

    //$mail->AltBody = '<img src="/'.trim($_POST['imagetosendEmail']).'" alt="Feliz Natal" align="center">';
    // Define os anexos (opcional)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    //$mail->AddAttachment(trim($_POST['imagetosendEmail']), "Cartao_de_Natal.jpg");  // Insere um anexo
    // Envia o e-mail
    if (isset($paramForm['anexo'])):
      $mail->AddAttachment($paramForm['arquivo']);
      $mail->AddAttachment($arquivo['arquivo']);
    endif;
    $enviado = $mail->Send();

    // Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();




    // Exibe uma mensagem de resultado
    if ($enviado) {

      return false;
    } else {

      return true;
    }
  }
  //--------------------------------------------------------------------------------------------------------------------------------
  public function sendmessagewithoptin($POST = NULL) {
    $addoptin = $this->Save($POST, NULL, 'dbo_application_optin', TRUE);
    $sendmsg = $this->sendMessage($POST, NULL);
    if (is_numeric($addoptin)):
      return array(
        'status' => 'success',
        'message' => 'Mensagem enviada com sucesso.'
      );
    else:
      return array(
        'status' => 'danger',
        'message' => 'Erro ao enviar sua mensagem, verifique os campos digitados e tente novamente.'
      );
    endif;
  }

}

?>
