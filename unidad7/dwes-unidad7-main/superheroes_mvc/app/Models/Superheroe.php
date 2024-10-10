<?php
namespace App\Models;

//No es necesario use App\Models\DBAbstractModel ya que está en el mismo espacio de nombres
class Superheroe extends DBAbstractModel {
	/*CONSTRUCCIÓN DEL MODELO SINGLETON*/
	private static $instancia;
	public static function getInstancia()
	{
	if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;	
	}
	public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
	
	private $id;
	private $nombre;
	private $velocidad;
	private $created_at;  
	private $updated_at;

	public function setId($id) {
		$this->id = $id;
	  }
	public function setNombre($nombre) {
	  $this->nombre = $nombre;
	}
	public function setVelocidad($velocidad) {
	  $this->velocidad = $velocidad ;
	}

	public function getMensaje() 
	{
       return $this->mensaje;
	}

	/*método para ver la implementación utilizando
	el mecanismo de cargar los datos en la entidad y luego
	persistirlos.
    */
	public function guardarenBD() {
		$this->query = "INSERT INTO superheroes(nombre, velocidad)
						VALUES(:nombre, :velocidad)";
		//$this->parametros['id']= $id;
		$this->parametros['nombre']= $this->nombre;
		$this->parametros['velocidad']= $this->velocidad;
		$this->getResultsFromQuery();
		//$this->execute_single_query();
		$this->mensaje = 'Superhéroes añadido.';
	}
	
	
	
	# Crear un nuevo usuario comprobando por código que no exista.
	public function set1($sh_data=array()) 
	{
			//Control de inserción.
		if(array_key_exists('id', $sh_data)) {
			$this->get($sh_data['id']);
			if($sh_data['id'] != $this->id) {
				foreach ($sh_data as $campo=>$valor) {
					$$campo = $valor;
            	}
				$this->query = "INSERT INTO superheroe(nombre, velocidad)
								VALUES(:nombre, :velocidad)";
				//$this->parametros['id']= $id;
				$this->parametros['nombre']= $nombre;
				$this->parametros['velocidad']= $velocidad;
				$this->getResultsFromQuery();
				//$this->execute_single_query();
				$this->mensaje = 'SH añadido';
			}
			else {
				$this->mensaje = 'El sh ya existe';
			}
		}
		else {
			$this->mensaje = 'No se ha agregado sh';
		}
	}
	
	public function set() 
	{
		
		$this->query = "INSERT INTO superheroes(nombre, velocidad)
						VALUES(:nombre, :velocidad)";
		$this->parametros['nombre']= $this->nombre;
		$this->parametros['velocidad']= $this->velocidad;
		$this->getResultsFromQuery();
		$this->mensaje = 'SH agregado correctamente';
		
	}
	
	
	
	
	/**
	* Método para traer un superheroe de la base de datos por clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function get($id='') 
	{
		if($id != '') {
			$this->query = "
				SELECT *
				FROM superheroes
				WHERE id = :id";
		//Cargamos los parámetros.
		$this->parametros['id']= $id;
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		}
		if(count($this->rows) == 1) {
			foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
			}
			$this->mensaje = 'sh encontrado';
		}
		else {
			$this->mensaje = 'sh no encontrado';
		}
		return $this->rows[0]??null;
	}
/**
	* Método para traer un libro de la base de datos por clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function getAll() 
	{
		$this->query = "SELECT * FROM superheroes";
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}

	/**
	* Método para traer un libro de la base de datos por clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function getSuperheroesByFilter($filter) 
	{
		$this->query = "SELECT * FROM superheroes where nombre like :filtro";
		$this->parametros['filtro']= '%'.$filter.'%';
	
		//Ejecutamos consulta que devuelve registros.
		
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}

    public function getSuperheroesLast() 
	{
		$this->query = "SELECT * FROM superheroes ORDER BY id DESC LIMIT ". SHPORPAGINA;
	    //Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}



# Edición desde array
public function editData($user_data=array()) 
{
   /*
   Campo updated_at es posible modificarlo creando un objeto datetime en php y enviando la fecha y hora en el parámetro
   o también utilizando la funcion mysql now en la propia consulta. 
   Es mejor con la función now, pero aquí lo hacemos creando el objeto para manejar fechas, horas.  
 
   */
 
	$fecha = new \DateTime();

	foreach ($user_data as $campo=>$valor) {
        $$campo = $valor;
    }
	
    $this->query = "
		UPDATE superheroes
		SET nombre=:nombre,
		velocidad=:velocidad,
		updated_at=:fecha
		WHERE id = :id
		";

	/*Opción de modificar updated_at con now de mysql
		$this->query = "
		UPDATE superheroes
		SET nombre=:nombre,
		velocidad=:velocidad,
		updated_at=now()
		WHERE id = :id
		";*/
   

	$this->parametros['id']=$id;
    $this->parametros['nombre']=$nombre;
    $this->parametros['velocidad']=$velocidad;

	$this->parametros['fecha']= date('Y-m-d H:i:s',$fecha->getTimestamp());
    $this->getResultsFromQuery();
    $this->mensaje = 'sh modificado';
}

# Edición persistiendo la entidad
public function edit() 
{
   /*
   Campo updated_at es posible modificarlo creando un objeto datetime en php y enviando la fecha y hora en el parámetro
   o también utilizando la funcion mysql now en la propia consulta. 
   Es mejor con la función now, pero aquí lo hacemos creando el objeto para manejar fechas, horas.  
   */
 
	$fecha = new \DateTime();
    $this->query = "
		UPDATE superheroes
		SET nombre=:nombre,
		velocidad=:velocidad,
		updated_at=:fecha
		WHERE id = :id
		";

	/*Opción de modificar updated_at con now de mysql
		$this->query = "
		UPDATE superheroes
		SET nombre=:nombre,
		velocidad=:velocidad,
		updated_at=now()
		WHERE id = :id
		";*/
   

	$this->parametros['id']=$this->id;
    $this->parametros['nombre']=$this->nombre;
    $this->parametros['velocidad']=$this->velocidad;

	$this->parametros['fecha']= date('Y-m-d H:i:s',$fecha->getTimestamp());
    $this->getResultsFromQuery();
    $this->mensaje = 'sh modificado';
}






# Eliminar un usuario
public function del($id='') 
{
    $this->query = "DELETE FROM superheroes
                    WHERE id = :id";
    $this->parametros['id']=$id;
    $this->getResultsFromQuery();
    $this->mensaje = 'SH eliminado';
}


# Eliminar un usuario
public function deleteEntidad() 
{
    $this->query = "DELETE FROM superheroes
                    WHERE id = :id";
    $this->parametros['id']=$this->id;
    $this->getResultsFromQuery();
    $this->mensaje = 'SH eliminado';
}



# Método constructor
function __construct() {
    // Singleton no recomienda parámetros ya que 
	// podría dificultar la lectura de las instancias.
	
	
}

}
?>