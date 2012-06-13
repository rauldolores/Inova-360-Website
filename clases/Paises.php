<?php 

include_once("Log.php");
include_once("Idiomas.php");
include_once("ZonasAdministrativas.php");
include_once("Ciudades.php");

class Paises{
	
	public $CONEXION;
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
	}
	

	function agregar($DATOS)
	{
		$IDIOMAS = new Idiomas();
		
		$DATOS['codigo'] = utf8_encode($DATOS['codigo']);
		$DATOS['pais'] = utf8_encode($DATOS['pais']);
		$DATOS['capital'] = utf8_encode($DATOS['capital']);
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;

			if(!$this->existe($DATOS['codigo']))
			{
				$COLECCION->insert($DATOS);	
				//TO-DO: validar si el pais que se agrega ya existe en la coleccion pero con otro codigo guardarlo en LOG
				//Esto podria significar que el codigo de algun pais ha cambiado, un caso remoto pero podria ocurrir
			}
			else
			{
				$COLECCION->update(array('codigo' => $DATOS['codigo']), array( '$set' => $DATOS));					

				//TO-DO: Actualizar las demas tablas en caso de que existan cambios en los datos de los paises
				//Para no sobrecargar la base de datos, antes se necesita validar que en realidad si tiene un nombre diferente
				//Se actualiza tabla de Zonas Administrativas
				/*$ZONAS = new ZonasAdministrativas();
				$ZONAS->actualizar(array('nombrePais' => $DATOS['pais']), 
						   array('codigoPais' => $DATOS['codigo']) );
				**/
				//Se actualiza tabla de Ciudades
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No es posible agregar el pais " . $codigo);
			return false;	
		}
		return $DATOS['codigo'];
	}

	function crearIndice($INDICE)
	{		
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;

			$COLECCION->ensureIndex($INDICE);			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No es posible crear un indice ");
			return false;	
		}
		return true;;
	}
	
	function existe($codigo)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;			
			$DATOS["codigo"] = $codigo;
			$PAISES = $COLECCION->findOne($DATOS);
					
			if(count($PAISES) == 0)
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No existe el pais " . $codigo);
			return false;
		}
		
		return true;		
	}
	
	function eliminar($directorioLenguajes, $codigo, $idioma)
	{
		$DATOS = array();
		$IDIOMAS = new Idiomas();
		try
		{
			$DATOS['codigo']=$codigo;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;

			$COLECCION->remove($DATOS);
			
			$IDIOMAS->eliminarPalabra($directorioLenguajes, $idioma, $codigo);
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No es posible eliminar el pais " . $codigo);
			return false;	
		}		
	}
	
	function editar($directorioLenguajes, $codigo, $nombre, $idioma)
	{
		$DATOS = array();
		$IDIOMAS = new Idiomas();
		
		$codigo = utf8_encode($codigo);
		$nombre = utf8_encode($nombre);
		
		try
		{
			$DATOS['codigo']=$codigo;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;

			$COLECCION->update(array('codigo' => $codigo), array( '$set' => $DATOS));
			
			$IDIOMAS->eliminarPalabra($directorioLenguajes, $idioma, $codigo);
			$IDIOMAS->agregarPalabra($directorioLenguajes, $idioma, 'paises', $codigo, $nombre);
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No es posible editar el pais " . $codigo);
			return false;	
		}		
		return true;
		
	}
	
	function lista($FILTRO)
	{
		$RESULTADO = array();
		
		try{

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;

			$cursor = $COLECCION->find($FILTRO);
			
			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registra("Paises", $e->getMessage(), "No es posible listar los paises");
			return false;
		}
		
		return false;
	}
	
	
	function tieneCiudades($codigoPais)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;			
			$DATOS["codigoPais"] = $codigoPais;
			$CIUDADES = $COLECCION->findOne($DATOS);
					
			if(count($CIUDADES) > 0)
			{
				return true;
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No existe la ciudad " . $nombre);
			return false;
		}
		
		return false;		
	}
	
	
	function obtenerNombre($codigoPais)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;			
			$DATOS["codigo"] = $codigoPais;
			$PAISES = $COLECCION->findOne($DATOS);
					
			if(count($PAISES) > 0)
			{
				return $PAISES["pais"];
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Paises", $e->getMessage(), "No existe la pais " . $codigoPais);
			return "";
		}
		
		return "";		
	}	
		

}

?>
