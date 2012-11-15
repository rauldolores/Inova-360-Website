<?php

	/*
	CAMPOS:
	-geonameid
	-ciudad
	-nombresAlternos
	-geoposicion: array('lat'=> 0000, 'lon' => 0000 )
	-codigoPais
	-nombrePais
	-fipsDivisionGeografica
	-poblacion
	-elevacion
	-zonaHoraria
	-fechaModificacionGeoname
	-totalLugares
	-totalUsuarios
	-nombreCorto: La funcion lo genera sola
	*/ 

include_once("Log.php");
include_once("Utilidades.php");

class Ciudades{
	
	public $CONEXION;
	public $UTILIDADES;	
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
		$this->UTILIDADES = new Utilidades();
	}
	
	function agregar($DATOS)
	{	
		$DATOS['ciudad'] = utf8_encode($DATOS['ciudad']);
		$DATOS['nombresAlternos'] = utf8_encode($DATOS['nombresAlternos']);
		$DATOS['nombrePais'] = utf8_encode($DATOS['nombrePais']);

		try
		{
			$DATOS['nombreCorto']=$this->UTILIDADES->limpiarURLCorta($DATOS['ciudad']);

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;
			
			//Si ya existe el nombre corto agragarle un modificador
			$CIUDADES = $COLECCION->findOne(array('nombreCorto' => $DATOS['nombreCorto'], '') );
			
			if(count($CIUDADES) > 0)
				$DATOS['nombreCorto'] = $DATOS['nombreCorto'] + "_"+ $DATOS['geonameid'];			

				
			if(!$this->existe($DATOS['geonameid']))
				$COLECCION->insert($DATOS);
			else
				$COLECCION->update(array('geonameid' => $DATOS['geonameid']), array( '$set' => $DATOS));
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Ciudades", $e->getMessage(), "No es posible agregar la ciudad " . $nombre);
			return false;	
		}
		return $DATOS['geonameid'];
	}
	
	function existe($geonameid)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;			
			$DATOS["geonameid"] = $geonameid;

			$ESTADOS = $COLECCION->findOne($DATOS);
					
			if(count($ESTADOS) == 0)
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Ciudades", $e->getMessage(), "No existe la ciudad " . $geonameid);
			return false;
		}
		
		return true;		
	}

	function crearIndice($INDICE)
	{		
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;

			$COLECCION->ensureIndex($INDICE);			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Ciudades", $e->getMessage(), "No es posible crear un indice ");
			return false;	
		}
		return true;;
	}	
	
	function eliminar($pais, $estado, $nombre)
	{
		$DATOS = array();
		
		try
		{
			$DATOS['nombre']=$nombre;
			$DATOS['estado']=$estado;
			$DATOS['pais']=$pais;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;

			$COLECCION->remove($DATOS);
			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Ciudades", $e->getMessage(), "No es posible eliminar el estado " . $nombre);
			return false;	
		}		
	}
	
	function editar($nombre, $latitud, $longitud, $pais, $estado, $timezone, $id)
	{
		$DATOS = array();
		
		$nombre = utf8_encode($nombre);
		
		try
		{
			$DATOS['nombre']=$nombre;
			$DATOS['latitud']=$latitud;
			$DATOS['longitud']=$longitud;
			$DATOS['pais']=$pais;
			$DATOS['estado']=$estado;
			$DATOS['timezone']=$timezone;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;

			$COLECCION->update(array('_id' => $id), array( '$set' => $DATOS));
			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Estados", $e->getMessage(), "No es posible editar el estado " . $nombre);
			return false;	
		}		
		return true;
		
	}
	
	function lista($FILTRO)
	{
		$DATOS = array();
		$RESULTADO = array();
		
		try{

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;

			$cursor = $COLECCION->find($FILTRO);
			
			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registra("Ciudades", $e->getMessage(), "No es posible listar las ciudades de " . $pais);
			return false;
		}
		
		return false;
	}
	
	function buscar($CONDICION)
	{
		$DATOS = array();

		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->ciudades;			
			$LUGAR = $COLECCION->findOne($CONDICION);
					
			if(!count($LUGAR))
				return false;
				
				
			return $LUGAR;
		}
		catch(Exception $e)
		{
			$LOG->registra("Ciudades", $e->getMessage(), json_encode($DATOS));	
		}					
	}			

}

?>
