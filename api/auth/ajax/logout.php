<?php

session_start();
session_destroy();

include_once("../../../clases/Cookie.php");		

Cookie::Eliminar('ID');

$mensaje = "";
header("Content-Type: text/javascript");
echo $_GET['callback'] . "(" . json_encode($mensaje) . ")";

?>
