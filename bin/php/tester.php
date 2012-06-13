<?php

include("../../clases/Paises.php");
include("../../clases/Ciudades.php");
include("../../clases/Generica.php");
include("../../config.php");


$CIUDADES = new Ciudades();
$PAISES = new Paises();
$GENERICA = new Generica();
$UTILIDADES = new Utilidades();


		$datosCompletosCiudades = $GENERICA->consultarTablaTemporal("CIUDADES", array("claseGeoname" => "P", "codigoGeoname" => "PPL"));
		//Obtenemos todas las zonas administrativas
		//$datosZonasAdministrativas = $GENERICA->consultarTablaTemporal("CIUDADES", array("claseGeoname" => "A", "codigoGeoname" => "ADM1"));
//print_r($datosCompletosCiudades);
$val = $datosCompletosCiudades->getNext();
echo "xxx: " . $val['ciudad'];
$i = 0;
foreach($datosCompletosCiudades as $r)
{
	if($i < 5)
	{
		echo $r['ciudad'] . " " . $r["claseGeoname"] . $r["fipsDivisionGeografica"] . "<br>";
	}
	$i++;
}

echo "Ciudades: " . count($datosCompletosCiudades) . "<br>";
//echo "Zonas: " . count($datosZonasAdministrativas);


?>
