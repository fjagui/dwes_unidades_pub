<?php
namespace App\Models;

//No es necesario use App\Models\DBAbstractModel ya que está en el mismo espacio de nombres
class Palabra extends DBAbstractModel {
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
	private $palabra;
	private $created_at;  
	private $updated_at;

	public function setId($id) 
	{
		$this->id = $id;
	}

	public function setPalabra($palabra) 
	{
	  $this->palabra = $palabra;
	}

	public function getMensaje() 
	{
       return $this->mensaje;
	}

	/**
	* Inserción de la palabra en la base de datos.
	*/
	public function set() 
	{
		$this->query = "INSERT INTO palabras(palabra)
						VALUES(:palabra)";
		$this->parametros['palabra']= $this->palabra;
	    $this->getResultsFromQuery();
		$this->mensaje = 'Insert Ok';
		
	}
	
	/**
	* Recuperación de palabra por id, clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function get($id='') 
	{
		$this->query = "SELECT *
						FROM palabras
						WHERE id = :id";
		//Cargamos los parámetros.
		$this->parametros['id']= $id;
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		
		if(count($this->rows) == 1) {
			//Cargamos la información de la bd en la entidad.
			foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
			}
			$this->mensaje = 'Ok';
		}
		else {
			$this->mensaje = 'Not found';
		}
		return $this->rows[0]??null;
	}

   /**
	* Recupera todos los registros de la tabla.
	*
	* @return datos.
	*/
	public function getAll() 
	{
		$this->query = "SELECT * FROM palabras";
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}

	/**
	* Método para traer todas las palabras de la tabla. Carga los resultado en el array definido en la clase abstracta.
	*
	* @param string filter.  Filtro de búsqueda.
	* @return datos.
	*/
	public function getPalabrasByFilter($filter) 
	{
		$this->query = "SELECT * FROM palabras where palabra like :filtro";
		$this->parametros['filtro']= '%'.$filter.'%';
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}

	/**
	* Últimas palabras introducidas.
	*
	* @return datos.
	*/
    public function getUltimasPalabras() 
	{
		$this->query = "SELECT * FROM palabras ORDER BY id DESC LIMIT ". SHPORPAGINA;
	    //Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}

    /**
	* Modificación de la entidad y persistencia en BD
	* 
	*/
	public function edit() 
	{
	/*
	Campo updated_at es posible modificarlo creando un objeto datetime en php y enviando la fecha y hora en el parámetro
	o también utilizando la funcion mysql now en la propia consulta. 
	Es mejor con la función now, pero aquí lo hacemos creando el objeto para manejar fechas, horas.  
	*/
	
		$fecha = new \DateTime();
		$this->query = "UPDATE palabras
						SET palabra=:palabra,
						    updated_at=:fecha
						WHERE id = :id";

		/*Opción de modificar updated_at con now de mysql
			$this->query = "
			UPDATE palabras
			SET palabra=:palabra,
			updated_at=now()
			WHERE id = :id
			";*/
	

		$this->parametros['id']=$this->id;
		$this->parametros['palabra']=$this->palabra;
		

		$this->parametros['fecha']= date('Y-m-d H:i:s',$fecha->getTimestamp());
		$this->getResultsFromQuery();
		$this->mensaje = 'sh modificado';
	}


	# Eliminar un usuario
	public function del($id='') 
	{
		$this->query = "DELETE FROM palabras
						WHERE id = :id";
		$this->parametros['id']=$id;
		$this->getResultsFromQuery();
		$this->mensaje = 'Del Ok';
	}




	# Método constructor
	function __construct() {
		// Singleton no recomienda parámetros ya que 
		// podría dificultar la lectura de las instancias.
		
		
	}

}
?>