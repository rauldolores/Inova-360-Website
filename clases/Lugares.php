<?php
include_once("Log.php");

class Lugares{

	public $CONEXION;
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
	}
	

	function agregar($DATOS)
	{
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->lugares;			
			
			$LUGAR = $COLECCION->findOne(
										array("geoposicion" => $DATOS['geoposicion'])
										);
			
			if(!count($LUGAR))
			{
				$COLECCION->insert($DATOS);			
				return $DATOS["_id"];
			}
			
			return false;
		}
		catch(Exception $e)
		{
			$LOG->registra("Lugares", $e->getMessage(), json_encode($DATOS));	
		}
	}
	
	function editar($CONDICION, $DATOS)
	{
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->lugares;			
			$COLECCION->update($CONDICION, array( '$set' => $DATOS));
		}
		catch(Exception $e)
		{
			$LOG->registra("Lugares", $e->getMessage(), json_encode($DATOS));	
		}
	}	
	
	
	
	function lista($FILTRO)
	{
		$DATOS = array();
		$RESULTADO = array();
		
		try{

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->lugares;

			$cursor = $COLECCION->find($FILTRO);
			
			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registra("Lugares", $e->getMessage(), "No es posible listar los lugares");
			return false;
		}
		
		return false;
	}	
	
	function obtener($alias)
	{
		$DATOS = array();
		$DATOS['urlCorta']=$alias;

		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->lugares;			
			$LUGAR = $COLECCION->findOne($DATOS);
					
			if(!count($LUGAR))
				return false;
				
				
			return $LUGAR;
		}
		catch(Exception $e)
		{
			$LOG->registra("Lugares", $e->getMessage(), json_encode($DATOS));	
		}					
	}
	
	function buscar($CONDICION)
	{
		$DATOS = array();

		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->lugares;			
			$LUGAR = $COLECCION->findOne($CONDICION);
					
			if(!count($LUGAR))
				return false;
				
				
			return $LUGAR;
		}
		catch(Exception $e)
		{
			$LOG->registra("Lugares", $e->getMessage(), json_encode($DATOS));	
		}					
	}		
}

