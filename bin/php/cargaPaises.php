<?php 
/*

	Autor: Raul Dolores Calzadilla
	Descripcion: 
			Realiza la carga o actualizacion de datos del catalogo de paises a partir de un catalogo
			de datos obtenido de Geonames.org. El catalogo se debe de descargar cada mes y esto se
			determina por la tabla LogFuentesExternas para determinar cuando fue la ultima fecha que recibimos
			el archivo.
			
			Tambien se realizan calculos estadisticos de cada pais y se actualizan los datos en los 
			respectivos registros.
			
	Periodo: Se tiene que ejecutar muy esporadicamente, por ejemplo cada mes

*/


//LLAMADO A LIBRERIAS NECESARIAS
include_once("../../clases/Utilidades.php");
include_once("../../clases/Paises.php");
include_once("../../clases/Log.php");
include_once("../../config.php");


//Se crean instancias
$PAISES = new Paises();
$UTILIDADES = new Utilidades();
$LOG = new Log();

try
{

	//Descargamos archivo de Paises
	$UTILIDADES->descargarArchivoRemoto("http://download.geonames.org/export/dump/countryInfo.txt", $CONFIG['PATH']  . "fuentes/paises/countryInfo.txt");

	//Cargamos a la base de datos los paises
	$datosPaises = file($CONFIG['PATH']  . "fuentes/paises/countryInfo.txt");

	foreach($datosPaises as $r)
	{
		if($r[0] != "#")
		{
			$DATOS = array();
	
			$datosLinea = explode("\t", $r);
	
	
			$DATOS['codigo'] = $datosLinea[0];
			$DATOS['codigoISO3'] = $datosLinea[1];
			$DATOS['codigoISONumero'] = $datosLinea[2];
			$DATOS['fips'] = $datosLinea[3];
			$DATOS['pais'] = $datosLinea[4];
			$DATOS['capital'] = $datosLinea[5];
			$DATOS['area'] = $datosLinea[6];
			$DATOS['poblacion'] = $datosLinea[7];
			$DATOS['continente'] = $datosLinea[8];
			$DATOS['tld'] = $datosLinea[9];
			$DATOS['monedaCodigo'] = $datosLinea[10];
			$DATOS['monedaNombre'] = $datosLinea[11];
			$DATOS['lenguajes'] = $datosLinea[15];
			$DATOS['geonameId'] = $datosLinea[16];
			$DATOS['vecinos'] = $datosLinea[17];

			$PAISES->agregar($DATOS);
	
		}
	}

	//Crear indice
	$PAISES->crearIndice(array("codigo" => 1));

	system("rm " . $CONFIG['PATH']  . "fuentes/paises/countryInfo.txt"); 


}
catch(Exception $e)
{
	$LOG->registraLog("cargaPaises", $e->getMessage(), "Ha ocurrido un error. ");
	return false;	
}



?>
