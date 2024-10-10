<?php
/**
 * Clase abstracta DBAbstractModel
 *
 * Esta clase proporciona una interfaz base para manejar conexiones a la base de datos.
 * Se encarga de la configuración de la conexión y proporciona métodos básicos para
 * realizar operaciones de CRUD (Crear, Leer, Actualizar, Eliminar) en la base de datos.
 * Las clases que extienden esta clase abstracta deben implementar los métodos abstractos
 * definidos aquí para realizar operaciones específicas sobre los datos.
 *
 * @category Modelos
 * @package  App\Models
 * @author   José Aguilera <joseaguilera@iesgrancapitan.org>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.iesgrancapitan.org
 * @version  1.0.1
 */

namespace App\Models;
abstract class DBAbstractModel {
    private static $db_host = DBHOST; // Host de la base de datos
    private static $db_user = DBUSER; // Usuario de la base de datos
    private static $db_pass = DBPASS; // Contraseña de la base de datos
    private static $db_name = DBNAME; // Nombre de la base de datos
    private static $db_port = DBPORT; // Puerto de la base de datos

    protected $mensaje = ''; // Mensaje de error o éxito
    private $conn; // Manejador de la conexión a la base de datos
    
    // Manejo básico para consultas
    protected $query; // Consulta SQL
    protected $parametros = array(); // Parámetros de entrada para consultas
    protected $rows = array(); // Array para almacenar resultados de consultas
    
    // Métodos abstractos que deben ser implementados en las clases derivadas
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function del();
    
    /**
     * Crea una conexión a la base de datos.
     *
     * Este método establece una conexión a la base de datos utilizando PDO. 
     * Configura la conexión para usar UTF-8 como conjunto de caracteres.
     *
     * @throws \PDOException Si no se puede establecer la conexión.
     * @return \PDO Conexión a la base de datos.
     */
    protected function openConnection()
    {
        $dsn = 'mysql:host=' . self::$db_host . ';'
              . 'dbname=' . self::$db_name . ';' 
              . 'port='  . self::$db_port;
        try {
            $this->conn = new \PDO($dsn, self::$db_user, self::$db_pass,
                                   array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $this->conn;
        } 
        catch (\PDOException $e) {
            throw new \Exception("Conexión fallida: " . $e->getMessage());
        }
    }
    
    /**
     * Devuelve el último ID introducido en la base de datos.
     *
     * Este método utiliza el manejador de conexión para recuperar el último ID
     * insertado en la base de datos después de una operación de inserción.
	 * Fundamental para las relaciones 1:n
     *
     * @return string Último ID insertado.
     */
    public function lastInsert() {
        return $this->conn->lastInsertId();
    }
    
    /**
     * Desconecta la base de datos.
     *
     * Este método cierra la conexión a la base de datos establecida en la clase.
     *
     * @return void
     */
    private function closeConnection() {
        $this->conn = null; // Destruir el objeto de conexión
    }
    
    /**
     * Ejecuta una consulta simple del tipo INSERT, DELETE, UPDATE.
     *
     * Este método permite ejecutar consultas que no devuelven filas. Se espera que
     * se realice a través de una solicitud POST.
     *
     * @return void
     * @throws \Exception Si el método no es permitido.
     */
    protected function executeSingleQuery() {
        if ($_POST) {
            try {
                $this->openConnection(); // Abrir conexión a la base de datos
                $this->conn->query($this->query); // Ejecutar la consulta
            } catch (\Exception $e) {
                throw new \Exception("Error al ejecutar la consulta: " . $e->getMessage());
            } finally {
                $this->closeConnection(); // Cerrar conexión
            }
        } 
        else {
            throw new \Exception('Método no permitido'); // Mensaje de error
        }
    }
    
    /**
     * Obtiene resultados de una consulta en un array.
     *
     * Este método ejecuta una consulta que devuelve filas y almacena los resultados
     * en el array `$rows`. Utiliza sentencias preparadas para evitar inyecciones SQL.
     *
     * @return void
     * @throws \Exception Si ocurre un error en la consulta.
     */
    protected function getResultsFromQuery() 
    {
        try {
            $this->openConnection(); // Abrir conexión
            if (($_stmt = $this->conn->prepare($this->query))) {
                // Verificar y vincular parámetros nombrados
                if (preg_match_all('/(:\w+)/', $this->query, $_named, PREG_PATTERN_ORDER)) {
                    $_named = array_pop($_named);
                    foreach ($_named as $_param) {
                        $_stmt->bindValue($_param, $this->parametros[substr($_param, 1)]);
                    }
                }
                
                if (!$_stmt->execute()) {
                    throw new \Exception("Error de consulta: " . $_stmt->errorInfo()[2]);
                }
                // Obtener resultados
                $this->rows = $_stmt->fetchAll(\PDO::FETCH_ASSOC);
                $_stmt->closeCursor(); // Cerrar el cursor
            }
        } 
        catch(\PDOException $e) {
            throw new \Exception("Error en consulta: " . $e->getMessage()); // Manejo de errores
        } 
        finally {
            $this->closeConnection(); // Asegurarse de que la conexión se cierra
        }
    }
}
