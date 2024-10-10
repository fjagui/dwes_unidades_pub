<?php
require_once('..\app\Config\parametros.php');
require_once('..\vendor\autoload.php');

use App\Controllers\AuthController;
use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\PalabraController;



ini_set('display_errors',1);
ini_set('display_starup_error',1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil']='invitado';
}

$router = new Router();
$router->add(array(
    'name'=>'home', 
    'path'=>'/^\/$/', 
    'action'=>[IndexController::class, 'IndexAction']));

$router->add(array(
     'name'=>'add_palabra', 
     'path'=>'/^\/palabras\/add$/', 
     'action'=>[PalabraController::class, 'AddPalabraAction']));

$router->add(array(
     'name'=>'edit_palabra', 
     'path'=>'/^\/palabras\/edit\/[0-9]{1,3}$/', 
     'action'=>[PalabraController::class, 'EditPalabraAction']));

$router->add(array(
     'name'=>'del_palabra', 
     'path'=>'/^\/palabras\/del\/[0-9]{1,3}$/', 
     'action'=>[PalabraController::class, 'DelPalabraAction']));

$router->add(array(
      'name'=>'search_palabra', 
      'path'=>'/^\/\?s=[\w.\-]{1,25}$/', 
      'action'=>[IndexController::class, 'IndexAction']));
$router->add(array(
      'name'=>'login', 
      'path'=>'/^\/login$/', 
      'action'=>[AuthController::class, 'LoginAction']));


/*
$router->add(array(
        'name'=>'show_resume', [\w.\-]{0,25}
        'path'=>'/^\/resultados$/', 
        'action'=>[IndexController::class, 'ActionResultados']));*/

//$router->handleRequest($_SERVER['REQUEST_URI']);
//Eliminamos el nombre del directorio base, no sería necesario si utiliasemos un host virtual.


$request=str_replace(DIRBASEURL,'',$_SERVER['REQUEST_URI']);
$route =$router->match($request);


if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo "No route";
}
