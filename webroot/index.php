<?php
//    $debut = microtime(true);
    //


    if(empty($_SESSION)){
        session_start();
//        echo 'pas de session';
//        $_SESSION['cmpt'] = +1;
    }else{
       echo 'session deja demaré';
    }

    $date = date_create();
    $version_number = date_timestamp_get($date);
    define('APPLI_NAME', 'BABI MARKET');
    define('WEBROOT_URL', 'http://localhost/Market/webroot/');
    define('SITE_BASE_URL', 'http://localhost/Market/');     
    define('WEBROOT', dirname(__FILE__));
    define('ROOT', dirname(WEBROOT));
    define('VERSION', $version_number);
//    define('DS', DIRECTORY_SEPARATOR);
    define('DS', '/');
    define('CORE', ROOT.DS.'core');
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
//    
    require CORE.DS.'includes.php';
    new Dispacher();  


//   echo '<pre>';
//   print_r(__FILE__);
//   echo '</pre>';
//   
//   echo '<pre>';
//   echo WEBROOT.'  dirname(__FILE__)';
//   echo '</pre>';
//   echo '<pre>';
//   echo ROOT.'  dirname(WEBROOT)';
//   echo '</pre>';
//   echo '<pre>';
//   echo DS.'  DS';
//   echo '</pre>';
//   echo '<pre>';
//   echo CORE.'  ROOT.DS.core';
//   echo '</pre>';
//   echo '<pre>';
//   echo BASE_URL.'  dirname(dirname($_SERVER[SCRIPT_NAME]))';
//   echo '</pre>';
?>


