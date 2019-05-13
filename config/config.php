<?php
    class conf{
        
        static $debug = 1;
        static $database = array(
            'default' => array(
              'dbname' => 'market',
              'hostname' => 'localhost',
              'login' => 'root',
              'passwd' => ''  
            )
        );
        
        static function redir(){
            if(!isset($_SESSION['user'])){
            header('Location: '.BASE_URL.DS.'accueil/index');            
       }       
      
       
      }   
        }   
   
?>
