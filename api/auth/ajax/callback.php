<?php

	include("../../../config.php");

	header("Content-Type: text/javascript");

	$callback = $_GET["callback"];
	$accion = $_GET["accion"];

	$variables = "";
	foreach($_GET as $clave => $valor)
	{
		$variables .= $clave . "=" . $valor . "&g";
	}

	$url = $CONFIG["DOMINIO"] . "api/auth/ajax/" . $accion .".php?" . $variables;

	$codigo = file_get_contents($url);

	$json = json_encode($codigo);

	$jsonp = $callback . "(" . $json . ")";

	echo $jsonp;
?>

