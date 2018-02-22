<?php
header("Content-type: text/html; charset=iso-8859-1");
//iniciando a conexão com o banco de dados
$host = "localhost"; $user = "root"; $pass = "12345";
$cx = mysqli_connect($host, $user, $pass);
//selecionando o banco de dados
$db = mysqli_select_db($cx, "unitt");
//criando a query de consulta à tabela criada
$sql = mysqli_query($cx, "SELECT * FROM dbo_application_settings WHERE id=1") or die(
  mysqli_error($cx) //caso haja um erro na consulta
);
//pecorrendo os registros da consulta.
while ($aux = mysqli_fetch_assoc($sql)) {
  $email_site = $aux["email_site"];
  $smtp_server = $aux["smtp_server"];
  $int_auth = $aux["int_auth"];
  $login_auth = $aux["login_auth"];
  $pass_auth = $aux["pass_auth"];
  $dominio = $aux["dominio"];
  $protocolo = $aux["protocolo"];
}
?>
