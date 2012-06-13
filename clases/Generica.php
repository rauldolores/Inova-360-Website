<?php 

include_once("Log.php");
include_once("Idiomas.php");

class Generica{
	
	public $CONEXION;
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
	}
		
	
	
	function agregarATablaTemporal($TABLA, $DATOS)
	{		
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);

			$COLECCION->insert($DATOS);			
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible agregar datos a la tabla temporal " . $TABLA);
			return false;	
		}
		return $DATOS["_id"];
	}	

	function crearIndiceATablaTemporal($TABLA, $INDICE)
	{		
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);

			$COLECCION->ensureIndex($INDICE);			
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible crear un indice " . $TABLA);
			return false;	
		}
		return true;;
	}	

	function eliminarIndicesATablaTemporal($TABLA)
	{		
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);

			$COLECCION->deleteIndexes();			
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible crear un indice " . $TABLA);
			return false;	
		}
		return $DATOS["_id"];
	}	
	
	function eliminaDeTablaTemporal($TABLA, $CONDICION)
	{
		$DATOS = array();
		$IDIOMAS = new Idiomas();
		try
		{

			$DB = $this->CONEXION->innet;
			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);

			$COLECCION->remove($CONDICION);
			
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible eliminar datos de la tabla temporal " . $TABLA);
			return false;	
		}		
	}	
	
	function consultarTablaTemporal($TABLA, $CONDICION)
	{

		try{
			$DB = $this->CONEXION->innet;

			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);


			$RESULTADO = $COLECCION->find($CONDICION);
					
			return $RESULTADO;
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible realizar una consulta " . $codigoPais);
			return "";
		}
		
		return "";		
	}	


	function consultarUnicoTablaTemporal($TABLA, $CONDICION)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);

			$RESULTADO = $COLECCION->findOne($CONDICION);
					
			return $RESULTADO;
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible realizar la consulta unica ");
			return "";
		}
		
		return "";		
	}	
	

	function eliminarColeccion($TABLA)
	{
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = new MongoCollection($DB, "temporal" . $TABLA);

			$RESULTADO = $COLECCION->drop();
					
		}
		catch(Exception $e)
		{
			$this->LOG->registraLog("Generica", $e->getMessage(), "No es posible eliminar la coleccion " . $TABLA);
			return "";
		}
		
		return "";		
	}	


}

?>
