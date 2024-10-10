<?php
require_once('..\app\Config\parametros.php');
require_once('..\vendor\autoload.php');

use App\Models\Superheroe;

$objSuperheroe = Superheroe::getInstancia();

var_dump($objSuperheroe);