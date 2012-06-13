<?php
session_start();

include_once("../../../clases/Usuarios.php");
include_once("../../../clases/Cookie.php");		
include_once("../../../clases/Sesion.php");

Sesion::forzarAbrirSesion();

$mensaje = "";
if(isset($_SESSION['ID']))
	$mensaje = "OK";


header("Content-Type: text/javascript");
echo $_GET['callback'] . "(" . json_encode($mensaje) . ")";

?>
