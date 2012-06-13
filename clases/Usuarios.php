<?php 

require_once("Log.php");
require_once("Cookie.php");

class Usuarios{

	public $nombre;
	public $apellidos;
	public $email;
	public $password;
	public $fechaNacimiento;
	public $pais;
	public $ciudad;
	public $genero;
	public $foto;
	public $alias;
	public $id;

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
			$DATOS['nombre']=$this->nombre;
			$DATOS['apellidos']=$this->apellidos;
			$DATOS['email']=$this->email;
			$DATOS['password']=$this->password;
			$DATOS['fechaNacimiento']=$this->fechaNacimiento;
			$DATOS['pais']=$this->pais;
			$DATOS['ciudad']=$this->ciudad;
			$DATOS['genero']=$this->genero;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->usuarios;			
			$COLECCION->insert($DATOS);
			
			$this->id = $DATOS["_id"];
		}
		catch(Exception $e)
		{
			$LOG->registra("Usuarios", $e->getMessage(), json_encode($DATOS));	
		}
	}

	function login()
	{
		$DATOS = array();
		$DATOS['email']=$this->email;
		$DATOS['password']=$this->password;
		
		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->usuarios;			
			$USUARIO = $COLECCION->findOne($DATOS);
					
			if(!count($USUARIO))
				return false;
			
			//Iniciar sesion
			$_SESSION["ID"] = $USUARIO["_id"]->__toString();
			$_SESSION["EMAIL"] = $USUARIO["email"];
			$_SESSION["PAIS"] = $USUARIO["pais"];
			$_SESSION["CIUDAD"] = $USUARIO["ciudad"];
			$_SESSION["GENERO"] = $USUARIO["genero"];
			$_SESSION["NOMBRE"] = $USUARIO["nombre"] . " " . $USUARIO["apellidos"];

			Cookie::Crear('ID', $USUARIO["_id"], Cookie::UnAño);
				
			if(strtoupper($USUARIO["genero"]) == "HOMBRE")
				$_SESSION["IMAGEN50X50"] = $this->CONFIG["RUTA_IMAGEN"] . $this->CONFIG["IMAGEN_DEFAULT_HOMBRE_50X50"];
			else
				$_SESSION["IMAGEN50X50"] = $this->CONFIG["RUTA_IMAGEN"] . $this->CONFIG["IMAGEN_DEFAULT_MUJER_50X50"];
			
			return true;
		}
		catch(Exception $e)
		{
			$LOG->registra("Usuarios", $e->getMessage(), json_encode($DATOS));	
		}			
	}	

	function forzarLogin($IdUsuario)
	{
		$DATOS = array();
		$DATOS['_id']=new MongoId($IdUsuario);
		
		try
		{		
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->usuarios;			
			$USUARIO = $COLECCION->findOne($DATOS);
					
			if(!count($USUARIO))
				return false;
			
			//Iniciar sesion
			$_SESSION["ID"] = $USUARIO["_id"];
			$_SESSION["EMAIL"] = $USUARIO["email"];
			$_SESSION["PAIS"] = $USUARIO["pais"];
			$_SESSION["CIUDAD"] = $USUARIO["ciudad"];
			$_SESSION["GENERO"] = $USUARIO["genero"];
			$_SESSION["NOMBRE"] = $USUARIO["nombre"] . " " . $USUARIO["apellidos"];

			Cookie::Crear('ID', $USUARIO["_id"], Cookie::UnAño);
				
			if(strtoupper($USUARIO["genero"]) == "HOMBRE")
				$_SESSION["IMAGEN50X50"] = $this->CONFIG["RUTA_IMAGEN"] . $this->CONFIG["IMAGEN_DEFAULT_HOMBRE_50X50"];
			else
				$_SESSION["IMAGEN50X50"] = $this->CONFIG["RUTA_IMAGEN"] . $this->CONFIG["IMAGEN_DEFAULT_MUJER_50X50"];
			
			return true;
		}
		catch(Exception $e)
		{
			$LOG->registra("Usuarios", $e->getMessage(), json_encode($DATOS));	
		}				
	}
	
	function obtenerUsuario($email)
	{
		
	}
}

?>
