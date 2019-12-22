<?php
$pdo = new PDO('mysql:dbname=market;host=localhost', 'root', '',
                             array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

define('WEBROOT_URL', 'http://localhost/Market/webroot/');
define('SITE_BASE_URL', 'http://localhost/Market/');
define('WEBROOT_FRONT_DIR', 'C:/wamp64/www/Market/webroot/');

//echo 'bd bien chargé';
