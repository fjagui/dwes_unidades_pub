<?php
/**
 * Clase BaseController
 *
 * Proporciona una funcionalidad base para controladores, permitiendo la 
 * renderización de archivos HTML y la inyección de datos dinámicos en las vistas.
 * 
 * Proyecto Superhéroes.
 * Unidad 6. DWES.
 * @category Controladores
 * @package  App\Controllers
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.iesgrancapitan.org
 * @version  1.0.0
 */

namespace App\Controllers;

class BaseController {

    /**
     * Renderiza una vista HTML.
     *
     * Este método se encarga de incluir un archivo HTML o plantilla,
     * permitiendo además pasar un array de datos para generar contenido dinámico
     * dentro de la vista.
     *
     * @param string $fileName Nombre o ruta del archivo HTML que se va a renderizar.
     * @param array  $data     Un array asociativo de datos que serán utilizados dentro de la vista.
     *                         Por defecto es un array vacío.
     * 
     * @return void
     */
    public function renderHTML($fileName, $data = []) {
        include($fileName);
    }
}
?>
