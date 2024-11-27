<?php
/**
* Script que contiene las funciones utilizadas en la apliación de exámenes.
* 
* @package u3Ex_ResExamenes
* @subpackage Librerías
* @author Jose Aguilera <joseaguilera@iesgrancapitan.orgg
* @category DWES
* @license MIT
* @version 1.0.0
* @since 2024-11-27 
*/



/**
 * Función utilizada para limpiar los datos de entrada teniendo utilizando un array
 *
 * @param [array] $dato
 * @return array
 */


function clearData($dato) {
    if (is_array($dato)) {
        // Si es un array, aplica la limpieza recursivamente
        return array_map('clearData', $dato);
    }
    // Limpieza para valores simples
    return htmlspecialchars(stripslashes(trim($dato)), ENT_QUOTES, 'UTF-8');
}
