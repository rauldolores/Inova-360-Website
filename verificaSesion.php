<?php
	include_once("clases/Sesion.php");
	include_once("clases/Usuarios.php");
	include_once("clases/Cookie.php");		

	session_start();
	Sesion::forzarAbrirSesion();
	
	$mensaje = "OFF";
	
	if(isset($_SESSION['ID']))
		$mensaje = base64_encode($_SESSION["ID"]);
	
	/*$RESULTADO = array();
	if(isset($_SESSION['ID']))
		$RESULTADO['STATUS'] = "ON";
	else
		$RESULTADO['STATUS'] = "OFF";*/

	header("Content-Type: text/javascript");
	echo $_GET['callback'] . "(" . json_encode($mensaje) . ")";
	//echo json_encode($mensaje);

?>
