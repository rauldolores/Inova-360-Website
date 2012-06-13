<?php 


class Sesion{

	
	function __construct() {
		//
	}

	/*
	Abre una sesion de usuario desde cookies existentes
	Es necesario usar session_start antes de invocar a este metodo
	*/
	static public function forzarAbrirSesion()
	{
		if(!isset($_SESSION['ID']))
		{
			if(Cookie::Existe("ID"))
			{
				//Forzar login
				$USUARIO = new Usuarios();
				$USUARIO->forzarLogin(Cookie::Obtener("ID"));
				
			}			
		}
	    return false;
	}
}

?>
