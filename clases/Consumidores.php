<?php 

include_once("Log.php");
include_once("Idiomas.php");

class Consumidores{
	
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
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->consumidores;

			$COLECCION->insert($DATOS);	
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Consumidores", $e->getMessage(), "No es posible agregar el consumidor ");
			return false;	
		}
		return $DATOS['_id'];
	}

	
	
	function eliminar($id)
	{
		$DATOS = array();
		try
		{
			$DATOS['_id']=new MongoId($id);

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->consumidores;

			$COLECCION->remove($DATOS);
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Consumidores", $e->getMessage(), "No es posible eliminar el consumidor " . $id);
			return false;	
		}		
	}
	
	function editar($DATOS, $id)
	{
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->paises;

			$COLECCION->update(array('_id' => new MongoId($codigo)), array( '$set' => $DATOS));
			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Consumidores", $e->getMessage(), "No es posible editar el consumidor " . $id);
			return false;	
		}		
		return true;
		
	}
	
	function lista($FILTRO)
	{	
		try{

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->consumidores;

			$cursor = $COLECCION->find($FILTRO);
			
			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registra("Consumidores", $e->getMessage(), "No es posible listar los consumidores");
			return false;
		}
		
		return false;
	}

	function obtenerConsumidor($FILTRO)
	{	
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->consumidores;

			$cursor = $COLECCION->findOne($FILTRO);
			
			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registra("Consumidores", $e->getMessage(), "No es posible obtener el consumidor");
			return false;
		}
		
		return false;
	}	
	
}

?>
