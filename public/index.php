<?php    
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = 'home/home';
if(isset($_GET['url'])){
    $url = $_GET['url'];
}

require_once (ROOT . DS . 'lib' . DS . 'bootstrap.php');