<?php
namespace App\Models;

//No es necesario use App\Models\DBAbstractModel ya que está en el mismo espacio de nombres
class Opcion extends DBAbstractModel {
	private $id;
	private $idPregunta;
	private $opcion;
	private $created_at;
	private $updated_at;
	

	# CONSTRUCCIÓN DEL MODELO SINGLETON
	private static $instancia;
	public static function getInstancia()
	{
	if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;	
	}
	# Se impide clonación, según patro Singleton
	public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

	# Constructor según patrón de diseño Singleton
	function __construct() {
		// Singleton no recomienda parámetros ya que 
		// podría dificultar la lectura de las instancias.
	}
	
	/**
	 * Persistencia de opción.
	 */
	public function set() 
	{
		$fecha = new \DateTime();
		$this->query = "INSERT INTO opciones(idPregunta, opcion, created_at)
						VALUES(:id_pregunta, :opcion, :created_at)";
		$this->parametros['id_pregunta']= $this->idPregunta;
		$this->parametros['opcion']= $this->opcion;
		$this->parametros['created_at']= date('Y-m-d H:i:s',$fecha->getTimestamp());
		$this->getResultsFromQuery();
		$this->mensaje = 'Insert Ok';

		/** 
		 *Por motivos de aprendizaje utilizamos un objeto DateTime. Más correcto utlizar la función now de mysql en la consulta
		 *o directamente que se encargue la BD-
		 */
	}

	/**
	 * Edición de la opción.
	 * 
	 */
	public function edit() 
	{
		# Objeto para la fecha, mejor en BD
		$fecha = new \DateTime();

		# Creamos la consulta
		$this->query = "UPDATE opciones
						SET idPregunta=:id_pregunta,
							opcion=:opcion,
						    updated_at=:fecha
						WHERE id = :id";
		
		# Asignamos parámetros
		$this->parametros['id']=$this->id;
		$this->parametros['id_pregunta']=$this->idPregunta;
		$this->parametros['opcion']=$this->opcion;
		$this->parametros['fecha']= date('Y-m-d H:i:s',$fecha->getTimestamp());
		 
		# Ejecutamos la consulta
		$this->getResultsFromQuery();

		# Mensaje.
		$this->mensaje = 'sh modificado';

	/*
	 *Campo updated_at es posible modificarlo creando un objeto datetime en php y enviando la fecha y hora en el parámetro
	 *o también utilizando la funcion mysql now en la propia consulta. 
	 *Es mejor con la función now, pero aquí lo hacemos creando el objeto para manejar fechas, horas. 
	 *Opción de modificar updated_at con now de mysql
	 *	 $this->query = "UPDATE palabras SET palabra=:palabra,updated_at=now() WHERE id = :id";
	 */

	}

	/**
	 * Delete  opcion function
	 * 
	 * @return void
	 */
	public function del() 
	{
		#query
		$this->query = "DELETE FROM opciones
						WHERE id = :id";
		#Parameters
		$this->parametros['id']=$this->id;
		
		#exec
		$this->getResultsFromQuery();
		
		#message
		$this->mensaje = 'Del Ok';
	}

	
	/**
	 * Recupera datos de opcion por id, clave primaria.
	 *
	 * @param [int] $id
	 * @return data or null
	 */
	public function get($id='') 
	{
		$this->query = "SELECT *
						FROM opciones
						WHERE id = :id";
		#Cargamos los parámetros.
		$this->parametros['id']= $id;
	
		#Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		
		if(count($this->rows) == 1) {
			#Cargamos la información de la bd en la entidad. No es necesario ya que la información la colocamos en $rows
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

    
	public function getByIdPregunta($idPregunta='') 
	{
		$this->query = "SELECT *
						FROM opciones
						WHERE idPregunta = :id_pregunta";
		#Cargamos los parámetros.
		$this->parametros['id_pregunta']= $idPregunta;
	
		#Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		$this->mensaje = 'Datos cargados';
		return $this->rows??null;
	}
	




	


	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

    /**
	 * Get the value of id
	 */ 
	public function getIdPregunta()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setIdPregunta($id)
	{
		$this->idPregunta = $id;

		return $this;
	}

	/**
	 * Get the value of id
	 */ 
	public function getOpcion()
	{
		return $this->opcion;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setOpcion($opcion)
	{
		$this->opcion = $opcion;

		return $this;
	}





}
?>