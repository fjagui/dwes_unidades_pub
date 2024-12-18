<?php
/**
 * Clase Superheroe
 *
 * Esta clase representa un superhéroe en el sistema y extiende la clase abstracta
 * DBAbstractModel para interactuar con la base de datos. Implementa métodos para
 * realizar operaciones CRUD en la tabla de superhéroes.
 * Definida con el patrón de diseño singleton.
 * 
 * Se incluyen métodos diferentes para las mismas funcionalidades con objeto de 
 * explicar las formas de persistir la información en la BD.
 *
 * @category Modelos
 * @package  App\Models
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.iesgrancapitan.org
 * @version  1.0.1
 */

 namespace App\Models;
 // No es necesario use App\Models\DBAbstractModel ya que está en el mismo espacio de nombres

class Superheroe extends DBAbstractModel {
    
    
    private static $instancia; // Instancia única de la clase

    /**
     * Obtiene la instancia única de la clase.
     *
     * Este método implementa el patrón Singleton, asegurando que solo haya
     * una instancia de la clase Superheroe.
     *
     * @return Superheroe Instancia de la clase Superheroe.
     */
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;  
    }

    /**
     * Previene la clonación de la instancia.
     *
     * Este método lanza un error si se intenta clonar la instancia de la clase,
     * manteniendo la integridad del patrón Singleton.
     *
     * @return void
     */

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    /** @var int $id Identificador del superhéroe. */
    private $id;
    /** @var string $nombre Nombre del superhéroe. */
    private $nombre;
    /** @var int $velocidad Velocidad del superhéroe. */
    private $velocidad;
    /** @var string $created_at Fecha de creación del superhéroe. */
    private $created_at;  
    /** @var string $updated_at Fecha de última actualización del superhéroe. */
    private $updated_at;

    /**
     * Establece el identificador del superhéroe.
     *
     * @param int $id Identificador del superhéroe.
     * @return void
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Establece el nombre del superhéroe.
     *
     * @param string $nombre Nombre del superhéroe.
     * @return void
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Establece la velocidad del superhéroe.
     *
     * @param int $velocidad Velocidad del superhéroe.
     * @return void
     */
    public function setVelocidad($velocidad) {
        $this->velocidad = $velocidad;
    }

    /**
     * Obtiene el mensaje del último resultado de operación.
     *
     * @return string Mensaje de resultado.
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    /**
     * Método para agregar un superhéroe comprobando que no exista.
     *
     * Este método verifica si un superhéroe ya existe en la base de datos antes de
     * intentar insertarlo. Si el superhéroe ya existe, devuelve un mensaje adecuado.
     * Método para explicar los dos métodos de persistir la información en la BD
	 * 
     * @param array $sh_data Datos del superhéroe a agregar.
     * @return void
     */
    public function set1($sh_data = array()) {
        // Control de inserción.
        if (array_key_exists('id', $sh_data)) {
            $this->get($sh_data['id']);
            if ($sh_data['id'] != $this->id) {
                foreach ($sh_data as $campo => $valor) {
                    $$campo = $valor;
                }
                $this->query = "INSERT INTO superheroes(nombre, velocidad)
                                VALUES(:nombre, :velocidad)";
                $this->parametros['nombre'] = $nombre;
                $this->parametros['velocidad'] = $velocidad;
                $this->getResultsFromQuery();
                $this->mensaje = 'Superhéroe añadido';
            } else {
                $this->mensaje = 'El superhéroe ya existe';
            }
        } else {
            $this->mensaje = 'No se ha agregado superhéroe';
        }
    }

    /**
     * Agrega un nuevo superhéroe a la base de datos.
     *
     * Este método inserta un nuevo registro en la tabla de superhéroes utilizando
     * los atributos de la instancia.
     *
     * @return void
     */
    public function set() {
        $this->query = "INSERT INTO superheroes(nombre, velocidad)
                        VALUES(:nombre, :velocidad)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['velocidad'] = $this->velocidad;
        $this->getResultsFromQuery();
        $this->mensaje = 'Superhéroe agregado correctamente';
    }

    /**
     * Obtiene un superhéroe de la base de datos por su identificador.
     *
     * Este método carga los datos del superhéroe en los atributos de la instancia
     * utilizando el identificador proporcionado.
     *
     * @param int $id Identificador del superhéroe a buscar.
     * @return array|null Datos del superhéroe o null si no se encuentra.
     */
    public function get($id = '') {
        if ($id != '') {
            $this->query = "
                SELECT *
                FROM superheroes
                WHERE id = :id";
            // Cargamos los parámetros.
            $this->parametros['id'] = $id;
            // Ejecutamos consulta que devuelve registros.
            $this->getResultsFromQuery();
        }

        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Superhéroe encontrado';
        } else {
            $this->mensaje = 'Superhéroe no encontrado';
        }
        return $this->rows[0] ?? null;
    }

    /**
     * Obtiene todos los superhéroes de la base de datos.
     *
     * Este método devuelve todos los registros de la tabla de superhéroes.
     *
     * @return array Datos de todos los superhéroes.
     */
    public function getAll() {
        $this->query = "SELECT * FROM superheroes";
        // Ejecutamos consulta que devuelve registros.
        $this->getResultsFromQuery();
        return $this->rows;
    }

    /**
     * Filtra y obtiene superhéroes por nombre.
     *
     * Este método permite buscar superhéroes cuyo nombre coincida con el filtro
     * proporcionado, devolviendo los resultados en un array.
     *
     * @param string $filter Filtro para buscar en los nombres.
     * @return array Datos de superhéroes que coinciden con el filtro.
     */
    public function getSuperheroesByFilter($filter) {
        $this->query = "SELECT * FROM superheroes 
                        WHERE nombre LIKE :nombre
                        ORDER BY id DESC LIMIT " . SHPORPAGINA;
        // Ejecutamos consulta que devuelve registros.
        $this->parametros['nombre'] = "%$filter%";
        $this->getResultsFromQuery();
        return $this->rows;
    }

    /**
     * Obtiene los últimos superhéroes añadidos.
     *
     * Este método devuelve los últimos registros de superhéroes, limitados por la
     * constante SHPORPAGINA.
     *
     * @return array Datos de los últimos superhéroes.
     */
    public function getSuperheroesLast() {
        $this->query = "SELECT * FROM superheroes ORDER BY id DESC LIMIT " . SHPORPAGINA;
        // Ejecutamos consulta que devuelve registros.
        $this->getResultsFromQuery();
        return $this->rows;
    }

    /**
     * Edita los datos de un superhéroe a partir de un array de datos.
     *
     * Este método actualiza los atributos del superhéroe en la base de datos y
     * modifica la fecha de actualización.
     *
     * @param array $user_data Datos del superhéroe a modificar.
     * @return void
     */
    public function editData($user_data = array()) {
        $fecha = new \DateTime();
        
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        
        $this->query = "
            UPDATE superheroes
            SET nombre = :nombre,
            velocidad = :velocidad,
            updated_at = :fecha
            WHERE id = :id
        ";

        $this->parametros['id'] = $id;
        $this->parametros['nombre'] = $nombre;
        $this->parametros['fecha'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->getResultsFromQuery();
        $this->mensaje = 'Superhéroe modificado';
    }

    /**
     * Edita los datos del superhéroe actual en la base de datos.
     *
     * Este método actualiza los atributos del superhéroe utilizando los valores
     * de la instancia actual.
     *
     * @return void
     */
    public function edit() {
        $fecha = new \DateTime();
        $this->query = "
            UPDATE superheroes
            SET nombre = :nombre,
            velocidad = :velocidad,
            updated_at = :fecha
            WHERE id = :id
        ";

        $this->parametros['id'] = $this->id;
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['velocidad'] = $this->velocidad;
        $this->parametros['fecha'] = date('Y-m-d H:i:s', $fecha->getTimestamp());
        $this->getResultsFromQuery();
        $this->mensaje = 'Superhéroe modificado';
    }

    /**
     * Elimina un superhéroe de la base de datos por su identificador.
     *
     * Este método ejecuta una consulta de eliminación utilizando el identificador
     * proporcionado.
     *
     * @param int $id Identificador del superhéroe a eliminar.
     * @return void
     */
    public function del($id = '') {
        $this->query = "DELETE FROM superheroes
                        WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->getResultsFromQuery();
        $this->mensaje = 'Superhéroe eliminado';
    }

    /**
     * Elimina la entidad de superhéroe actual de la base de datos.
     *
     * Este método ejecuta una consulta de eliminación utilizando el identificador
     * de la instancia actual.
     *
     * @return void
     */
    public function deleteEntidad() {
        $this->query = "DELETE FROM superheroes
                        WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->getResultsFromQuery();
        $this->mensaje = 'Superhéroe eliminado';
    }
}
?>
