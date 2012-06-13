<?php 

include_once("Log.php");
include_once("Diccionarios.php");

class Idiomas{

	public $nombre;
	public $codigo;
	public $id;
	public $directorio;
	
	public $CONEXION;
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
	}
	

	function agregar($directorio, $codigo, $nombre)
	{
		$DATOS = array();
		
		$codigo = utf8_encode($codigo);
		$nombre = utf8_encode($nombre);
		
		try
		{	
			$DATOS['codigo']=$codigo;
			$DATOS['nombre']=$nombre;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->idiomas;
 
			$IDIOMA = $COLECCION->findOne(array('codigo' => $codigo));

			if(count($IDIOMA) == 0)
			{			
				$COLECCION->insert($DATOS);
			}
			
			//Si el directorio del lenguaje no existe crearlo
			if(!file_exists($directorio . strtolower($codigo)))
			{
				mkdir($directorio . strtolower($codigo));				
			}
			
			$this->id = $DATOS["_id"];
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), json_encode($DATOS));
			return false;	
		}
		
		return true;
	}
	
	function eliminar($directorio, $codigo)
	{
		
		$DATOS = array();
		
		try
		{	
			$DATOS['codigo']=$codigo;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->idiomas;
			
			$manejador = opendir($directorio . strtolower($codigo));
			
			if(readdir($manejador) == false)			
				$COLECCION->remove($DATOS, array("safe" => true));
			else
			{				
				$this->LOG->registra("Idiomas", "", "Aun existen diccionarios para este idioma. Es necesario eliminarlos antes.");
				return false;	
			}
			
			//Si el directorio del lenguaje no existe crearlo
			if(!file_exists($directorio . strtolower($codigo)))
			{
				rmdir($directorio . strtolower($codigo));				
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), json_encode($DATOS));
			return false;	
		}	

		return true;
	}

	function listaIdiomas()
	{
		$IDIOMAS = array();		
		
		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->idiomas;			
			$IDIOMAS = $COLECCION->find();
					
			if(count($IDIOMAS) == 0)
			{
				return false;
			}
						
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), json_encode($IDIOMAS));
			return false;	
		}	
		return $IDIOMAS;		
	}	
	
	function cargar($directorio, $idioma, $diccionario)
	{
		$datos = array();
		try{
			$DICCIONARIOS = new Diccionarios();
			$archivo = $directorio . $idioma . "/" . $diccionario . ".lang";
			$datos = $DICCIONARIOS->cargar($archivo);
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), json_encode($datos));
			return false;
		}
		
		return $datos;
	}
	
	function agregarPalabra($directorio, $idioma, $diccionario, $palabra, $traduccion)
	{
		try{
			$DICCIONARIOS = new Diccionarios();
			if($DICCIONARIOS->crear($directorio . $idioma . "/", $diccionario . ".lang"))
			{
				if(!$DICCIONARIOS->agregarPalabra($directorio . $idioma . "/", $diccionario . ".lang", $palabra, $traduccion))
				{
					$this->LOG->registra("Idiomas", "", json_encode($datos));
					return false;					
				}				
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), "No fue posible agregar la palabra " . $palabra . " de el diccionario " . $directorio . $idioma);
			return false;
		}
		
		return $datos;		
	}
	
	function eliminarPalabra($directorio, $idioma, $palabra)
	{
		try{
			$DICCIONARIOS = new Diccionarios();
			if(!$DICCIONARIOS->eliminarPalabra($directorio . $idioma . "/", $diccionario . ".lang", $palabra))
			{
				$this->LOG->registra("Idiomas", "", "No fue posible eliminar la palabra " . $palabra . " de el diccionario " . $directorio . $idioma);
				return false;					
			}				
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), json_encode($datos));
			return false;
		}
		
		return $datos;
	}
	
	function obtenerIdiomaActual()
	{
		//mexico.konoce.com/es/lugar/afroditas-mens-club
		$idioma = "";
		
		try
		{
			if(isset($_GET["idioma"]))
			{
				$idioma = strtolower($_GET["idioma"]);
			}else{
				$idioma = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);				
			}			
			
			if(!$this->existe($idioma))
			{
				$idioma = "en";	
			}			
			
		}catch(Exception $e){
			$this->LOG->registra("Idiomas", $e->getMessage(), "No es posible obtener el idioma actual");
			return false;			
		}
		
		return $idioma;
	}
	
	function existe($idioma)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->idiomas;			
			$DATOS["codigo"] = $idioma;
			$IDIOMAS = $COLECCION->findOne($DATOS);
					
			if(count($IDIOMAS) == 0)
			{
				$this->LOG->registra("Idiomas", "", "No existe el idioma " . $idioma);
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Idiomas", $e->getMessage(), "No existe el idioma " . $idioma);
			return false;
		}
		
		return true;		
	}
	
	
}

?>
