<?php

class Controller 
{
     
    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;
    protected $variables = [];
 
    function __construct($model, $controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;
 
        $this->$model = new $model;
        if($action !== ''){
            $this->_template = new Template($controller,$action);
        }
 
    }
 
    function set($name,$value) {
        if(is_object($this->_template)){
            $this->_template->set($name,$value);
        } else {
            $this->variables[$name] = $value;
        }
    }
 
    function __destruct() {
        if(is_object($this->_template)){
            $this->_template->render();
        }
    }
         
}