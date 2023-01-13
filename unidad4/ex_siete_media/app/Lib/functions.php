<?php
/**
 * Función que calcula los puntos de un conjunto de cartas.
 *
 * @param [type] $cartas
 * @return float
 */
function sumarPuntos($cartas) : float
{
    $puntos=0;
    foreach ($cartas as $clave=>$carta) {
        
        $puntos += ($carta%10 > 0 and $carta%10 < 8) ? $carta%10:0.5;
     
    }

    return $puntos;
}