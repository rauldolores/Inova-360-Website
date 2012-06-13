<?php

session_start();
session_destroy();

$mensaje = "";
header("Content-Type: text/javascript");
echo $_GET['callback'] . "(" . json_encode($mensaje) . ")";

?>
