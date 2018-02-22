<?php

$PHPSESSID = isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : sha1(time());
// define("VENDOR_DIR", str_replace(DIRECTORY_SEPARATOR, '/', str_replace('app', '', realpath(dirname(__FILE__)))));
define("__DIR__", str_replace(DIRECTORY_SEPARATOR, '/', str_replace('', '', realpath(dirname(__FILE__)))));

include('library/SetConnect.php');

/*
 * APPLICATION CONFIGURATIONS
 */
 define("__PHP_KEY_COOKIE", $protocolo);
define("_HTTP_PROTOCOL_SET", $protocolo);
define("__PHP_KEY_SESSION", $PHPSESSID);
define("__ttl_expired", 60);
define("__ACCESS_TOKEN_AUTH", '_WEBSERV_SessionAuthenticateKey');
define("__domain_cookie", '.SERVER__' . $dominio);
define('__setDomainSecurity', $dominio);
define('Site', $protocolo . $dominio . '/');
define('SitePath', $protocolo . $dominio . '/assets/');

// TCP port to connect to
define('SiteMail', $email_site); //email_site
define('SmtpServer', $smtp_server); //smtp_server
define('AccoServer', $login_auth); //login_auth
define('PassServer', $pass_auth); //pass_auth
define('AuthServer', $int_auth); //int_auth
define('__mainPath__', '/');
define('___Bundle___', 'Bundles');
define('___ROUTING_YML___', '../app/config/routing.yml');


/*
 * PAGE HEADERS
 */
header('Pragma: public');
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header("Content-Type: text/html; charset=utf-8", true);
header("Access-Control-Allow-Origin: *");



/*
 * CKFINDER

setcookie("ck_authorized", "true", 0, "/"); */
