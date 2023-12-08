<?php
/*
 * App Core Class
 * Create URL & Load Core Controller
 * URL Format - controller/method/param
 */

class Core {
    protected $currentController = 'Web';
    protected $currentMethod = 'index';
    protected $params=[];

    public function __construct()
    {
        $url=$this->getUrl();
        //look in controllers for first value
        if (!empty($url) && file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            //if exists set as controller
            $this->currentController=ucwords($url[0]);
            //unset 0 index
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/'.$this->currentController.'.php';

        //init the controller
        $this->currentController=new $this->currentController;

        //check for second part of url
        if (isset($url[1])){
            if (method_exists($this->currentController,$url[1])){
                $this->currentMethod=$url[1];
            }
            //unset 1 index
            unset($url[1]);
        }

        //Get Params
        $this->params=$url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->currentController,$this->currentMethod],$this->params);

    }

    public function getUrl(){
        if (isset($_GET['url'])){
            $url=rtrim($_GET['url'],'/');
//            $url=filter_var($url,FILTER_SANITIZE_URL);
            return explode('/',$url);
        }else{
            return [];
        }
    }

}
