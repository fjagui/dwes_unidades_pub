<?php
require_once('../app/Config/parametros.php');
require_once('../vendor/autoload.php');

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\NumerosController;

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


$router = new Router();
$router->add(array(
    'name'=>'home', 
    'path'=>'/^\/$/', 
    'action'=>[IndexController::class, 'IndexAction']));
    
$router->add(array(
    'name'=>'numeros', 
    'path'=>'/^\/numeros\/$/', 
    'action'=>[NumerosController::class, 'NumerosAction']));

$router->add(array(
    'name'=>'numeros', 
    'path'=>'/^\/saludo\/[A-z]+$/', 
    'action'=>[IndexController::class, 'SaludaAction']));
/*
$router->add(array(
        'name'=>'show_resume', 
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
