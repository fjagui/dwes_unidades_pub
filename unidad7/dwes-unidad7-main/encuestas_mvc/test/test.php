<?php
require_once('..\app\Config\parametros.php');
require_once('..\vendor\autoload.php');

use App\Models\Pregunta;
use App\Models\Opcion;
/*
$objPregunta= Pregunta::getInstancia();
$objPregunta->setDescripcion('¿Cómo ha resultado el curso?');
$objPregunta->addOpciones('Bien');
$objPregunta->addOpciones('Mal');
$objPregunta->addOpciones('Regular');
$objPregunta->set();*/

#Edición de opción
$objOpcion = Opcion::getInstancia();
$objOpcion->setId(25);
$objOpcion->setIdPregunta(24);
$objOpcion->setOpcion('REGULAR');
$objOpcion->edit();
echo "Registro modificado";
$objOpcion->del();
echo "Registro borrado";

$datos = $objOpcion->get(24);
var_dump($datos);
echo "<br/>";
$datos = $objOpcion->getByIdPregunta(3);
foreach ($datos as $clave=>$opcion) {
    foreach ($opcion as $valor) {
         echo $valor."<br/>";
    }
}

