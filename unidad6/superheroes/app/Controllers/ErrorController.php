<?php
/**
 * Clase IndexController.
 * 
 * Controlador de la página de inicio.
 * Soporta la búsqueda de superhéroes mediante una petición GET,
 * filtrando los resultados en base a una consulta proporcionada por el usuario.
 
 * Proyecto: Superheroes
 * Unidad: 6. DWES
 * @category Controladores
 * @package  App\Controllers
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.iesgrancapitan.org
 * @version  1.0.0
 */

namespace App\Controllers;


/**
 * Clase IndexController
 * 
 * */
class ErrorController extends BaseController 
{
    /**
     * Acción que lista los superhéroes. 
     *
     * Este método sirve como punto de entrada para la página de inicio,
     * mostrando la lista de los superhéroes. 
     * Si se recibe una petición GET con un parámetro `q`, se filtran los 
     * resultados según ese filtro. 
     * En caso contrario, se muestran los superhéroes más recientes.
     * 
     * @return void
     */
    public function ShowAction($request) {
        $data= array("mensaje"=>$request);
        // Renderizar la vista con los datos correspondientes
        $this->renderHTML('../views/error_view.php', $data);
    }
}
?>
