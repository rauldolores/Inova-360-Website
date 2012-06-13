<?php

session_start();

header("Content-Type: text/javascript");
	
include_once('../../../config.php');
include_once('../../../clases/Usuarios.php');
include_once('../../../clases/Log.php');		
	
$mensaje = "";

try{

	if(isset($_GET['AJAX']))
	{		
		if($_GET['ACCION'] == "loginUsuario")
		{
			$LOG = new Log();
			try
			{
				$USUARIO = new Usuarios();		
				$USUARIO->email = $_GET['email'];
				$USUARIO->password = $_GET['password'];
				$USUARIO->CONFIG = $CONFIG;

				if(!$USUARIO->login())
					$mensaje = "El usuario o el password no existen. Por favor, revisa los datos.";				
			}
			catch(Exception $e)
			{
				$LOG->registra("Login", $e->getMessage(), "Ocurrio un error al intentar firmarse con el usuario " . $email);
				$mensaje = "Ocurrio un error al intentar firmarse. Intentelo nuevamente mas tarde.";
			}
		}				
	}else{
		$mensaje = "Llamada no valida";
	}
}catch(Exception $e){
	$LOG->registra("Login", $e->getMessage(), "Ocurrio un error al intentar firmarse con el usuario " . $email);
}


echo $_GET['callback'] . "(" . json_encode($mensaje) . ")";

?>
