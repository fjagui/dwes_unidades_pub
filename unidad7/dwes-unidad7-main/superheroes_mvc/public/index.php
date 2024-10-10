<?php
require_once('../app/Config/parametros.php');
require_once('../vendor/autoload.php');

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\SuperHeroeController;




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
     'name'=>'add_superheroe', 
     'path'=>'/^\/superheroes\/add$/', 
     'action'=>[SuperheroeController::class, 'AddSuperHeroeAction']));

$router->add(array(
     'name'=>'add_superheroe', 
     'path'=>'/^\/superheroes\/edit\/[0-9]{1,3}$/', 
     'action'=>[SuperheroeController::class, 'EditSuperHeroeAction']));

$router->add(array(
     'name'=>'add_superheroe', 
     'path'=>'/^\/superheroes\/del\/[0-9]{1,3}$/', 
     'action'=>[SuperheroeController::class, 'DelSuperHeroeAction']));


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
