<?php
//load config
require_once 'config/config.php';

//load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/function_helper.php';
require_once '../vendor/autoload.php';


//require_once "libraries/Core.php";
//require_once "libraries/Controller.php";
//require_once "libraries/Database.php";

function health_mvc($className){
    require_once 'libraries/'.$className.'.php';
}
spl_autoload_register('health_mvc');
