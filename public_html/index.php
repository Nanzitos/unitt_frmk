<?php
/*function ob_html_compress($buf){
    return str_replace(array("\n","\r","\t"),'',$buf);
} 
ob_start("ob_html_compress");*/ 
session_start();
ob_start(); 


date_default_timezone_set('America/Sao_Paulo');

/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(64800);
$cache_expire = session_cache_expire();

/* Define o limite de tempo e local para guardar os arquivos de session */
session_set_cookie_params(99999999, '/', '.local'); 
session_save_path("/app/log/_session/"); 

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);

#include('../app/app_errors.php');  
include('../app/app_global.php');  
include('../app/app_kernel.php');


try {
     
    $loaderModule = new Autoloader();
    $loaderModule->loadModule();
    
    } catch (Exception $e) {

        die('ERROR: ' . $e->getMessage());
    }

    ob_end_flush();

