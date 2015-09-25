<?php
/** Check if environment is development and display errors **/
 
function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors','On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors','Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
    }
}
 
/** Check for Magic Quotes and remove them **/
 
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}
 
function removeMagicQuotes() {
    if ( get_magic_quotes_gpc() ) {
        $_GET    = stripSlashesDeep($_GET   );
        $_POST   = stripSlashesDeep($_POST  );
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}
 
/** Main Call Function **/
 
function callHook($url) {
    // Security Check
    $security = new SecurityController('Security', 'SecurityController', '');
    if(!$security->securityCheck()){
        // Change url 
        $url = 'security/login';
    }
    
    // Back to our regurerly scheduled programming.
    $urlArray = array();
    $urlArray = explode("/",$url);
    
    // Get controller from the url
    $controller = $urlArray[0];
    array_shift($urlArray);// Drop the first item off the url array
    
    // Get the action off the url 
    $action = ((isset($urlArray[0])) ? $urlArray[0] : "");
    array_shift($urlArray); // Drop the action off the url array
    
    // Set query string
    $queryString = $urlArray;
    $controllerName = $controller;
    $controller = ucwords($controller);
    
    $model = inflect::singularize($controller);
    $controller .= 'Controller';
    try {
        $dispatch = new $controller($model,$controllerName,$action);
    } catch (Exception $e) {
        echo $e->getMessage(), "\n";
    }
    
 
    if ((int)method_exists($controller, $action)) {
        call_user_func_array(array($dispatch,$action),$queryString);
    } else {
        /* Error Generation Code Here */
    }
}
 
/** Autoload any classes that are required **/
 
function __autoload($className) {
    
    if (file_exists(ROOT . DS . 'lib' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'lib' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

setReporting();
removeMagicQuotes();
//unregisterGlobals();
callHook($url);