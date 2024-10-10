<?php
require_once('..\app\Config\parametros.php');
require_once('..\vendor\autoload.php');

use App\Models\Superheroe;
$objSuperHeroe = Superheroe::getInstancia();
$objSuperHeroe->setNombre('Spiderman');
$objSuperHeroe->setVelocidad(18);
var_dump($objSuperHeroe);
echo "<br/>";
$objSuperHeroe1 = new $objSuperHeroe();
$objSuperHeroe1->setNombre('Spiderman');
$objSuperHeroe1->setVelocidad(18);
var_dump($objSuperHeroe1);