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

class ZonasAdministrativas{
	
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
			$COLECCION = $DB->zonasAdministrativas;
			
			//Si ya existe el nombre corto agregarle un modificador
			$ZONAS = $COLECCION->findOne(array('nombreCorto' => $DATOS['nombreCorto'], '') );
			
			if(count($ZONAS) > 0)
				$DATOS['nombreCorto'] = $DATOS['nombreCorto'] + "_"+ $DATOS['geonameid'];

				
			if(!$this->existe($DATOS['geonameid']))
				$COLECCION->insert($DATOS);
			else
				$COLECCION->update(array('geonameid' => $DATOS['geonameid']), array( '$set' => $DATOS));

			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("ZonasAdministrativas", $e->getMessage(), "No es posible agregar la ciudad " . $DATOS['ciudad']);
			return false;	
		}
		return $DATOS['geonameid'];
	}

	
	function existe($geonameid)
	{	
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->zonasAdministrativas;			
			$DATOS["geonameid"] = $geonameid;
			$ZONAADMINISTRATIVA = $COLECCION->findOne($DATOS);
				
			if(count($ZONAADMINISTRATIVA) == 0)
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("ZonasAdministrativas", $e->getMessage(), "No existe la zona administrativa ");
			return false;
		}
		
		return true;		
	}


	function crearIndice($INDICE)
	{		
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->zonasAdministrativas;

			$COLECCION->ensureIndex($INDICE);			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("ZonasAdministrativas", $e->getMessage(), "No es posible crear un indice ");
			return false;	
		}
		return true;;
	}	
	
	function eliminar($pais, $nombre)
	{
		$DATOS = array();
		
		try
		{
			$DATOS['nombre']=$nombre;
			$DATOS['pais']=$pais;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->zonasAdministrativas;

			$COLECCION->remove($DATOS);
			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("ZonasAdministrativas", $e->getMessage(), "No es posible eliminar la Zona Administrativa " . $nombre);
			return false;	
		}		
	}
	
	function actualizar($DATOS, $CONDICION)
	{
		$DATOS = array();
		
		$DATOS['ciudad'] = utf8_encode($DATOS['ciudad']);
		$DATOS['nombresAlternos'] = utf8_encode($DATOS['nombresAlternos']);
		$DATOS['nombrePais'] = utf8_encode($DATOS['nombrePais']);
		
		try
		{

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->zonasAdministrativas;

			$COLECCION->update($CONDICION, $DATOS);
			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("ZonasAdministrativas", $e->getMessage(), "No es posible editar la zona administrativa " . $nombre);
			return false;	
		}		
		return true;
		
	}
	
	function lista($FILTRO)
	{
		
		try{

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->zonasAdministrativas;

			$cursor = $COLECCION->find($FILTRO);
			
			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registraLog("ZonasAdministrativas", $e->getMessage(), "No es posible listar las Zonas Administrativas de " . $pais);
			return false;
		}
		
		return false;
	}
	
	
	function consultarUna($filtro)
	{
		$RESULTADO = array();
		
		try{			

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->zonasAdministrativas;

			$RESULTADO = $COLECCION->findOne($filtro);
		
		}catch(Exception $e){
			$this->LOG->registraLog("Estados", $e->getMessage(), "No es posible listar obtener la zona administrativa");
			return false;
		}
		
		return $RESULTADO;
	}	

}

?>
