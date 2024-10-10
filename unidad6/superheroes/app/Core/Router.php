<?php
/**
 * Clase Router
 *
 * Esta clase es responsable de gestionar las rutas de la aplicación. 
 * Permite añadir nuevas rutas y buscar rutas que coincidan con una solicitud dada. 
 * Las rutas se definen con patrones que puedenser utilizados para el enrutamiento 
 * de solicitudes HTTP a sus correspondientes controladores y acciones.
 *
 * Proyecto: Superheroes
 * Unidad: 6. DWES
 * @category Núcleo
 * @package  App\Core
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.iesgrancapitan.org
 * @version  1.0.1
 */
namespace App\Core;
class Router
{
    /**
     * @var array $routes
     * 
     * Este array contiene todas las rutas registradas en el enrutador.
     * Cada ruta es un array asociativo que incluye un patrón de ruta 
     * (expresión regular), un nombre, y un array con el controlador y la acción
     * que se deben invocar cuando se hace una coincidencia.
     *
     * Ejemplo de estructura de ruta:
     * [
     *     'path' => '/^\/superheroes\/(\d+)$/',
     *     'name' => 'view_superhero',
     *     'controller' => 'SuperHeroeController',
     *     'action' => 'viewAction'
     * ]
     */
    private $routes = array();

    /**
     * Añade una nueva ruta al enrutador.
     *
     * Este método permite registrar una nueva ruta en el enrutador. Las rutas deben ser definidas
     * como un array que contenga al menos el patrón de ruta y los detalles del controlador y la acción.
     *
     * @param array $route Array asociativo que define la ruta.
     * @throws \InvalidArgumentException Si la ruta no contiene todos los elementos requeridos.
     * @return void
     */
    public function add(array $route)
    {
        // Validar que la ruta contenga los elementos requeridos
        if (empty($route['path']) || empty($route['name']) || empty($route['action'])) {
            throw new \InvalidArgumentException('La ruta debe contener "path", "name",  y "action".');
        }

        // Validar que el patrón de la ruta sea una expresión regular válida
        if (@preg_match($route['path'], '') === false) {
            throw new \InvalidArgumentException('El patrón de la ruta no es una expresión regular válida.');
        }

        $this->routes[] = $route;
    }

    /**
     * Busca una ruta que coincida con la solicitud dada.
     *
     * Este método recibe una cadena de solicitud y 
     * busca en el conjunto de rutas registradas para encontrar una que coincida con el patrón de la ruta. 
     * Utiliza expresiones regulares para verificar coincidencias.
     *
     * @param string $request La solicitud entrante a la que se le va a hacer coincidir una ruta.
     * @return array|null Devuelve el array de la ruta coincidente o null si no hay coincidencias.
     */
    public function match(string $request)
    {
        $matches = array();
        
        // Iterar sobre cada ruta registrada para encontrar coincidencias
        foreach ($this->routes as $route) {
            $patron = $route['path'];
            // Verificar si la solicitud coincide con el patrón de la ruta
            if (preg_match($patron, $request)) {
                $matches = $route;
                break; // Se encontró una coincidencia, salir del bucle
            }
        }

        return $matches;    
    }
}
