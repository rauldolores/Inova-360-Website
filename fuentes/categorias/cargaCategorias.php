<?php

$CONEXION = new Mongo();

$DB = $CONEXION->innet;
$COLECCION = $DB->categoriasNegocios;

$categorias = file("categorias.txt");

$principal = "xx";
$secundario = "";
$final = array();
foreach($categorias as $c)
{
	$c = trim($c);
	if($c[0] == "#")
	{
		$principal = utf8_encode(str_replace("#", "", $c));
		$categoria = array("categoria" => $principal);		
		$final[] = $categoria;
	}
	else
	{
		$secundaria = utf8_encode($c);
		$categoria = array("padre" => $principal, "categoria" => $secundaria);
		$final[] = $categoria;
	}
}

$COLECCION->batchInsert($final);

?>
