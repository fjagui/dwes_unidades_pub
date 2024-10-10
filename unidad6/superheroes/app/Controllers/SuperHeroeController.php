<?php
/**
 * Controlador de superhéroes.
 *
 * Esta clase proporciona las acciones necesarias para gestionar
 * superhéroes dentro de la aplicación.
 * Incluye las acciones para agregar, eliminar y editar superhéroes
 * 
 * Proyecto: Superheroes
 * Unidad: 6. DWES
 * Autor: José Aguilera
 * Correo: joseaguilera@iesgrancapitan.org
 * 
 * @category Controladores
 * @package  App\Controllers
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.iesgrancapitan.org
 * @version  1.0.1
 */

namespace App\Controllers;

use App\Models\Superheroe;

/**
 * Clase SuperHeroeController
 *
 * Controlador responsable de manejar las acciones relacionadas con los superhéroes,
 * como agregar, editar y eliminar superhéroes. 
 * Extiende de BaseController y utiliza el modelo Superheroe.
 * Se implementa el saneamiento de entradas para evitar inyecciones de código.
 */
class SuperHeroeController extends BaseController 
{
    /**
     * Acción para agregar un nuevo superhéroe.
     *
     * Este método procesa el formulario de creación de un nuevo superhéroe, 
     * validando y saneando los datos ingresados. 
     * Si los datos son válidos, se guarda un nuevo superhéroe en la base de datos.
     * Si no son válidos, muestra los errores correspondientes.
     * 
     * @return void
     */
    public function addSuperHeroeAction() {
        $lprocesaFormulario = false;
        $data = array();
        $data['nombre'] = $data['velocidad'] = "";
        $data['msgErrorNombre'] = $data['msgErrorVelocidad'] = "";

        if (!empty($_POST)) {
            // Saneamos las entradas antes de utilizarlas
            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $data['velocidad'] = filter_input(INPUT_POST, 'velocidad', FILTER_SANITIZE_STRING);

            $lprocesaFormulario = true;

            // Validamos que el campo nombre no esté vacío
            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msgErrorNombre'] = "El nombre no puede estar vacío";
            }

            // Validamos que el campo velocidad no esté vacío
            if (empty($data['velocidad'])) {
                $lprocesaFormulario = false;
                $data['msgErrorVelocidad'] = "La velocidad no puede estar vacía";
            }
        }

        if ($lprocesaFormulario) {
            // Guardar el superhéroe en la base de datos
            $objSuperHeroe = Superheroe::getInstancia();
            $objSuperHeroe->setNombre($data['nombre']);
            $objSuperHeroe->setVelocidad($data['velocidad']);
            $objSuperHeroe->set();
            header('Location:'.DIRBASEURL.'/');
        } else {
            // Mostrar la vista de agregar superhéroe con los datos y errores
            $this->renderHTML('../views/addSuperheroe_view.php', $data);
        }
    }

    /**
     * Acción para eliminar un superhéroe.
     *
     * Este método recibe una petición con la identificación del superhéroe a eliminar, lo borra de la base
     * de datos y redirige al usuario a la página principal.
     * 
     * @param string $request El identificador del superhéroe que se va a eliminar, recibido en la URL.
     * 
     * @return void
     */
    public function delSuperHeroeAction($request) {
        $elementos = explode('/', $request);
        $id = end($elementos);
        $objSuperHeroe = Superheroe::getInstancia();
        $objSuperHeroe->del($id);
        header('Location:'.DIRBASEURL.'/');
    }

    /**
     * Acción para editar un superhéroe.
     *
     * Este método muestra un formulario con los datos del superhéroe seleccionado para su edición.
     * Sanea y valida los datos del formulario y, si son correctos, actualiza la información del superhéroe
     * en la base de datos. 
     * Si el superhéroe no existe, muestra un mensaje de error.
     * 
     * @param string $request El identificador del superhéroe a editar, recibido en la URL.
     * 
     * @return void
     */
    public function EditSuperHeroeAction($request) {
        $elementos = explode('/', $request);
        $id = end($elementos);
        $data = array();
        $objSuperHeroe = Superheroe::getInstancia();
        $datosSH = $objSuperHeroe->get($id);

        if ($datosSH) {
            $lprocesaFormulario = false;
            $data['nombre'] = $datosSH['nombre'];
            $data['velocidad'] = $datosSH['velocidad'];
            $data['msgErrorNombre'] = $data['msgErrorVelocidad'] = "";

            if (!empty($_POST)) {
                // Saneamos las entradas
                $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
                $data['velocidad'] = filter_input(INPUT_POST, 'velocidad', FILTER_SANITIZE_STRING);

                $lprocesaFormulario = true;

                // Validamos que el campo nombre no esté vacío
                if (empty($data['nombre'])) {
                    $lprocesaFormulario = false;
                    $data['msgErrorNombre'] = "El nombre no puede estar vacío";
                }

                // Validamos que el campo velocidad no esté vacío
                if (empty($data['velocidad'])) {
                    $lprocesaFormulario = false;
                    $data['msgErrorVelocidad'] = "La velocidad no puede estar vacía";
                }
            }

            if ($lprocesaFormulario) {
                // Actualizar el superhéroe en la base de datos
                $objSuperHeroe->setNombre($data['nombre']);
                $objSuperHeroe->setVelocidad($data['velocidad']);
                $objSuperHeroe->edit();
                header('Location:'.DIRBASEURL.'/');
            } else {
                // Mostrar la vista de edición con los datos y errores
                $this->renderHTML('../views/editSuperheroe_view.php', $data);
            }
        } else {
            // Mostrar un error si el superhéroe no existe
            $this->renderHTML('../views/error_view.php', array("mensaje" => "El SuperHéroe no existe"));
        }
    }
}
?>
