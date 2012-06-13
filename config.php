<?php 

/*
VARIABLES DE AMBIENTE
*/

//$CONFIG["AMBIENTE"] = ""; //Produccion
//$CONFIG["AMBIENTE"] = "UAT";  //Calidad y Pruebas
$GLOBAL["AMBIENTE"] = "DEV"; //Desarrollo

$GLOBAL["PATH"] = "/var/www/Produccion/";	

if($GLOBAL["AMBIENTE"] == "DEV")
	$GLOBAL["PATH"] = "/var/www/Desarrollo/";	
else if($GLOBAL["AMBIENTE"] == "UAT")
	$GLOBAL["PATH"] = "/var/www/UAT/";	
else if($GLOBAL["AMBIENTE"] == "")
	$GLOBAL["PATH"] = "/var/www/Produccion/";	


/*
VARIABLES DE APLICACION
*/
$CONFIG["PATH"] = $GLOBAL["PATH"] . "inova360.com/";
$CONFIG["DOMINIO"] = "http://www.inova360" . strtolower($GLOBAL["AMBIENTE"]) .".com/";
$CONFIG["RUTA_IMAGEN"] = "http://localhost/innet/konoce.com/cloud/imagenes/";
$CONFIG["IMAGEN_DEFAULT_HOMBRE_50X50"] = "defaultHombre50x50.gif";
$CONFIG["IMAGEN_DEFAULT_MUJER_50X50"] = "defaultMujer50x50.gif";

//DEFINIR LOS PAISES PARA LOS QUE SE VAN A CARGAR LAS CIUDADES
$paisesPorCargar = array(0 => "MX");

?>
