<?php
require_once('..\app\Config\parametros.php');




require_once('..\vendor\autoload.php');

use App\Controllers\DefaultController;

$controller = new DefaultController;
$controller->saludaAction();
$controller->numerosAction();
