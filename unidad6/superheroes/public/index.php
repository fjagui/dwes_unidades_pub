<?php
/**
 * Front Controller del proyecto Superhéroes.
 * CRUD Básico sin autentificación y con búsqueda en servidor
 * Patrón de diseño MODELO-VISTA-CONTROLADOR
 * Configurado para trabajar con virtual host.
 * 
 * Proyecto Superhéroes.
 * Unidad 6. DWES.
 * @category Front Controller
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @version  1.0.0
*/ 

// Activar la visualización de errores durante el proceso de desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar archivos necesarios para la aplicación
require_once("../bootstrap.php"); // Carga la configuración básica y la inicialización
require_once('../app/config/parametros.php'); // Carga parámetros de configuración
require_once('../vendor/autoload.php'); // Autocarga de clases usando Composer

// Uso de las  clases necesarias
use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\SuperHeroeController;

// Crear una instancia del enrutador
$router = new Router();

// Definición de las rutas de la aplicación
$router->add(array(
    'name' => 'home', 
    'path' => '/^\/$/', // Ruta para la página principal
    'action' => [IndexController::class, 'IndexAction'] // Acción a ejecutar
));

$router->add(array(
    'name' => 'search', 
    'path' => '/^\/superheroes\/search\?q=.*$/', // Ruta para buscar superhéroes
    'action' => [IndexController::class, 'IndexAction'] // Acción a ejecutar
));

$router->add(array(
    'name' => 'add_superheroe', 
    'path' => '/^\/superheroes\/add$/', // Ruta para añadir un nuevo superhéroe
    'action' => [SuperHeroeController::class, 'AddSuperHeroeAction'] // Acción a ejecutar
));

$router->add(array(
    'name' => 'edit_superheroe', 
    'path' => '/^\/superheroes\/edit\/[0-9]{1,3}$/', // Ruta para editar un superhéroe por ID
    'action' => [SuperHeroeController::class, 'EditSuperHeroeAction'] // Acción a ejecutar
));

$router->add(array(
    'name' => 'del_superheroe', 
    'path' => '/^\/superheroes\/del\/[0-9]{1,3}$/', // Ruta para eliminar un superhéroe por ID
    'action' => [SuperHeroeController::class, 'DelSuperHeroeAction'] // Acción a ejecutar
));

// Eliminar el nombre del directorio base de la URL. No necesario cuando trabajamos con VirtualHost
$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);
$route = $router->match($request); // Coincidir la ruta actual con las definidas

// Si se encuentra una coincidencia, crear el controlador y ejecutar la acción
if ($route) {
    $controllerName = $route['action'][0]; // Nombre del controlador
    $actionName = $route['action'][1]; // Nombre de la acción
    $controller = new $controllerName; // Instanciar el controlador
    $controller->$actionName($request); // Ejecutar la acción correspondiente
} else {
    // Si no hay coincidencia de ruta, mostrar un mensaje de error
    echo "No route";
}
