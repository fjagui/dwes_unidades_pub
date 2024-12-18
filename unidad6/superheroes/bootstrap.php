<?php
/**
 * Archivo que centraliza las configuraciones e inicializa los elementos esenciales
 * para que la aplicación funcione correctamente.
 * 
 * Proyecto Superhéroes.
 * Unidad 6. DWES.
 * @category Inicialización
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @version  1.0.0
*/ 

require 'vendor/autoload.php';
use Dotenv\Dotenv;

//Cargamos el fichero .env que está en __DIR__
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Definimos las constantes.
define("DBHOST", $_ENV['DBHOST']);
define("DBNAME", $_ENV['DBNAME']);
define("DBUSER", $_ENV['DBUSER']);
define("DBPASS", $_ENV['DBPASS']);
define("DBPORT", $_ENV['DBPORT']);


