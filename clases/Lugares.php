<?php
require("Log.php");

class Lugares{

	public $id;	
	public $alias;
	public $nombre;
	public $telefono;
	public $localizacion;
	public $categorias;
	public $verificado;
	public $web;
	public $estadisticas;
	public $creado;
	public $actualizado;
	public $comentarios;
	public $preguntas;
	public $konoceURL;
	public $konoceURLCorta;
	public $eventos;
	public $fotos;
	public $visitantes;
	public $seguidores;
	public $modificaciones;
	public $cerrado;
	public $horario;
	public $lugarPadre;
	public $esEmpresa;
	public $promociones;
	public $administradores;
	public $empleados;
	
	public $CONEXION;
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
	}
	

	function agregar()
	{
		$DATOS = array();
		
		try
		{
			$DATOS['alias']=$this->alias;
			$DATOS['nombre']=$this->nombre;
			$DATOS['telefono']=$this->telefono;
			$DATOS['localizacion']=$this->localizacion;
			$DATOS['categorias']=$this->categorias;
			$DATOS['verificado']=$this->verificado;
			$DATOS['web']=$this->web;
			$DATOS['estadisticas']=$this->estadisticas;
			$DATOS['creado']=$this->creado;
			$DATOS['actualizado']=$this->actualizado;
			$DATOS['comentarios']=$this->comentarios;
			$DATOS['preguntas']=$this->preguntas;
			$DATOS['konoceURL']=$this->konoceURL;
			$DATOS['konoceURLCorta']=$this->konoceURLCorta;
			$DATOS['eventos']=$this->eventos;
			$DATOS['fotos']=$this->fotos;
			$DATOS['visitantes']=$this->visitantes;
			$DATOS['seguidores']=$this->seguidores;
			$DATOS['modificaciones']=$this->modificaciones;
			$DATOS['cerrado']=$this->cerrado;
			$DATOS['horario']=$this->horario;
			$DATOS['lugarPadre']=$this->lugarPadre;
			$DATOS['esEmpresa']=$this->esEmpresa;
			$DATOS['promociones']=$this->promociones;
			$DATOS['admnistradores']=$this->administradores;
			$DATOS['empleados']=$this->empleados;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->usuarios;			
			$COLECCION->insert($DATOS);
			
			$this->id = $DATOS["_id"];
		}
		catch(Exception $e)
		{
			$LOG->registra("Lugares", $e->getMessage(), json_encode($DATOS));	
		}
	}
	
	function obtener()
	{
		$DATOS = array();
		$DATOS['alias']=$this->alias;

		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->lugares;			
			$LUGAR = $COLECCION->findOne($DATOS);
					
			if(!count($LUGAR))
				return false;
			
			$this->id = $LUGAR["id"];
			$this->alias = $LUGAR["alias"];
			$this->nombre = $LUGAR["nombre"];
			$this->telefono = $LUGAR["telefono"];
			$this->localizacion = $LUGAR["localizacion"];
			$this->categorias = $LUGAR["categorias"];
			$this->verificado = $LUGAR["verificado"];
			$this->web = $LUGAR["web"];
			$this->estadisticas = $LUGAR["estadisticas"];
			$this->creado = $LUGAR["creado"];
			$this->actualizado = $LUGAR["actualizado"];
			$this->comentarios = $LUGAR["comentarios"];
			$this->preguntas = $LUGAR["preguntas"];
			$this->konoceURL = $LUGAR["konoceURL"];
			$this->konoceURLCorta = $LUGAR["konoceURLCorta"];
			$this->eventos = $LUGAR["eventos"];
			$this->fotos = $LUGAR["fotos"];
			$this->visitantes = $LUGAR["visitantes"];
			$this->modificaciones = $LUGAR["modificaciones"];
			$this->seguidores = $LUGAR["seguidores"];
			$this->cerrado = $LUGAR["cerrado"];
			$this->horario = $LUGAR["horario"];
			$this->lugarPadre = $LUGAR["lugarPadre"];
			$this->esEmpresa = $LUGAR["esEmpresa"];
			$this->promociones = $LUGAR["promociones"];
			$this->administradores = $LUGAR["administradores"];
			$this->empleados = $LUGAR["empleados"];
				
				
			return true;
		}
		catch(Exception $e)
		{
			$LOG->registra("Lugares", $e->getMessage(), json_encode($DATOS));	
		}					
	}
}

