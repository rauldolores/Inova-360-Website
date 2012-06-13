<?php 

/*

	Autor: Raul Dolores Calzadilla
	Descripcion: 
			Realiza la carga o actualizacion de datos del catalogo de ciudades a partir de un catalogo
			de datos obtenido de Geonames.org (http://download.geonames.org/export/dump/<PAIS>.zip). 
			El catalogo se debe de descargar cada mes y esto se determina por la tabla LogFuentesExternas 
			para determinar cuando fue la ultima fecha que recibimos el archivo.
			
			Tambien se realizan calculos estadisticos de cada pais y se actualizan los datos en los 
			respectivos registros.

*/





/*
FALTA QUE SE CARGUEN CIUDADES COMO MONTERREY Y TOLUCA.
*/





//LLAMADO A LIBRERIAS NECESARIAS
include_once("../../clases/Utilidades.php");
include_once("../../clases/Paises.php");
include_once("../../clases/ZonasAdministrativas.php");
include_once("../../clases/Ciudades.php");
include_once("../../clases/Generica.php");
include_once("../../clases/Log.php");
include_once("../../config.php");


//Se crean instancias
$CIUDADES = new Ciudades();
$ZONAS = new ZonasAdministrativas();
$PAISES = new Paises();
$GENERICA = new Generica();
$UTILIDADES = new Utilidades();
$LOG = new Log();

try
{

	$procesaCiudades = false;

	foreach($paisesPorCargar as $p)
	{

		$tieneCiudades = $PAISES->tieneCiudades($p);
		if(!$tieneCiudades)
			$procesaCiudades = true;
	}


	if($procesaCiudades)
	{
		//Descargamos archivo de relaciones entre Divisiones Geograficas para cada ciudad
		$UTILIDADES->descargarArchivoRemoto("http://download.geonames.org/export/dump/admin1CodesASCII.txt", $CONFIG['PATH']  . "fuentes/ciudades/admin1CodesASCII.txt");
		chmod($CONFIG['PATH']  . "fuentes/ciudades/admin1CodesASCII.txt", 0777);

		//Cargamos en una coleccion temporal el archivo admin1CodesASCII.txt
		$datosFipsDivisionGeografica = file($CONFIG['PATH']  . "fuentes/ciudades/admin1CodesASCII.txt");

		foreach($datosFipsDivisionGeografica as $d)
		{
			$DATOS = array();
			$datosLinea = explode("\t", trim($d));
	
			$DATOS['geonameid'] = $datosLinea[3];
			$DATOS['fips'] = $datosLinea[0];
	
			$GENERICA->agregarATablaTemporal("admin1CodesASCII", $DATOS);
		}

		//Crear indice
		$GENERICA->crearIndiceATablaTemporal("admin1CodesASCII", array("fips" => 1));

		system("rm " . $CONFIG['PATH']  . "fuentes/ciudades/admin1CodesASCII.txt"); 
	}

	//Carga de ciudades
	foreach($paisesPorCargar as $p)
	{

		$archivoDestino = $CONFIG['PATH']  . "fuentes/ciudades/" . $p . ".zip";
		$carpetaGenerada = $CONFIG['PATH']  . "fuentes/ciudades/" . $p . "/";
		$tieneCiudades = $PAISES->tieneCiudades($p);
		$nombrePais = $PAISES->obtenerNombre($p);

		//Validar si es la carga inicial
		//Si es la carga inicial se descarga toda la base de datos	
		if(!$tieneCiudades)
		{
			$UTILIDADES->descargarArchivoRemoto("http://download.geonames.org/export/dump/" . $p . ".zip", $archivoDestino);

			chmod($archivoDestino, 0777);
			system("unzip ". $archivoDestino);
			system("rm " . $archivoDestino); 
			system("rm " . $CONFIG['PATH'] . "bin/php/readme.txt"); 
			system("mv " . $CONFIG['PATH'] . "bin/php/" . $p . ".txt " . $CONFIG['PATH']  . "fuentes/ciudades/" . $p . ".txt"); 
			chmod($CONFIG['PATH']  . "fuentes/ciudades/" . $p . ".txt", 0777);
		
			$lineas = file($CONFIG['PATH']  . "fuentes/ciudades/" . $p . ".txt");

			//Cargamos en una coleccion temporal el archivo <<PAIS>>.txt
			foreach($lineas as $r)
			{
				$datosLinea = explode("\t", trim($r));
			
				$DATOS = array();
			
				$DATOS['geonameid'] = $datosLinea[0];
				$DATOS['ciudad'] = $datosLinea[1];
				$DATOS['nombresAlternos'] = $datosLinea[3];
				$DATOS['geoposicion'] = array("lat" => (float)$datosLinea[4], "lon" => (float)$datosLinea[5] );
				$DATOS['codigoPais'] = $datosLinea[8];
				$DATOS['claseGeoname'] = $datosLinea[6];
				$DATOS['codigoGeoname'] = $datosLinea[7];
				$DATOS['fipsDivisionGeografica'] = $p . "." .$datosLinea[10];
				$DATOS['poblacion'] = $datosLinea[14];
				$DATOS['elevacion'] = $datosLinea[15];
				$DATOS['zonaHoraria'] = $datosLinea[17];
				$DATOS['fechaModificacionGeoname'] = $datosLinea[18];
			
				$GENERICA->agregarATablaTemporal("CIUDADES", $DATOS);
			}

			//Se crea indice
			$GENERICA->crearIndiceATablaTemporal("CIUDADES", array("claseGeoname" => 1, "codigoGeoname" => 1));
			$GENERICA->crearIndiceATablaTemporal("CIUDADES", array("geonameid" => 1));

			//Obtenemos todas las ciudades
			$datosCompletosCiudades = $GENERICA->consultarTablaTemporal("CIUDADES", array("claseGeoname" => "P", "codigoGeoname" => "PPL"));
			//Obtenemos todas las zonas administrativas
			$datosZonasAdministrativas = $GENERICA->consultarTablaTemporal("CIUDADES", array("claseGeoname" => "A", "codigoGeoname" => "ADM1"));


			$ZONAS->crearIndice(array("nombreCorto" => 1));
			$ZONAS->crearIndice(array("geonameid" => 1));
			$ZONAS->crearIndice(array("codigoPais" => 1));
			$ZONAS->crearIndice(array("geoposicion" => "2d"));

			//Cargamos el catalogo de zona administrativas
			foreach($datosZonasAdministrativas as $r)
			{
				$DATOS = array();					
		
				$DATOS['geonameid'] = $r['geonameid'];
				$DATOS['ciudad'] = $r['ciudad'];
				$DATOS['nombresAlternos'] = $r['nombresAlternos'];
				$DATOS['geoposicion'] = $r['geoposicion'];
				$DATOS['codigoPais'] = $r['codigoPais'];
				$DATOS['nombrePais'] = $nombrePais;
				$DATOS['poblacion'] = $r['poblacion'];
				$DATOS['elevacion'] = $r['elevacion'];
				$DATOS['zonaHoraria'] = $r['zonaHoraria'];
				$DATOS['fechaModificacionGeoname'] = $r['fechaModificacionGeoname'];
				$DATOS['totalLugares'] = 0;
				$DATOS['totalUsuarios'] = 0;
			
				$ZONAS->agregar($DATOS);
			}


			$CIUDADES->crearIndice(array("geonameid" => 1));
			$CIUDADES->crearIndice(array("nombreCorto" => 1));
			$CIUDADES->crearIndice(array("codigoPais" => 1));
			$CIUDADES->crearIndice(array("nombreDivisionGeografica" => 1));
			$CIUDADES->crearIndice(array("geoposicion" => "2d"));

			//Cargamos el catalogo de ciudades
			foreach($datosCompletosCiudades as $r)
			{

				$DATOS = array();			
			
				//Obtener datos de la Division Geografica
				$idDivisonGeografica = $GENERICA->consultarUnicoTablaTemporal("admin1CodesASCII", array("fips" => $r['fipsDivisionGeografica']));				
				$datosDivisonGeografica = $ZONAS->consultarUna(array("geonameid" => $idDivisonGeografica['geonameid']));

		
				$DATOS['geonameid'] = $r['geonameid'];
				$DATOS['ciudad'] = $r['ciudad'];
				$DATOS['nombresAlternos'] = $r['nombresAlternos'];
				$DATOS['geoposicion'] = $r['geoposicion'];
				$DATOS['codigoPais'] = $r['codigoPais'];
				$DATOS['nombrePais'] = $nombrePais;
				$DATOS['geonameidDivisionGeografica'] = $idDivisonGeografica['geonameid'];
				$DATOS['nombreDivisionGeografica'] = $datosDivisonGeografica['ciudad'];
				$DATOS['poblacion'] = $r['poblacion'];
				$DATOS['elevacion'] = $r['elevacion'];
				$DATOS['zonaHoraria'] = $r['zonaHoraria'];
				$DATOS['fechaModificacionGeoname'] = $r['fechaModificacionGeoname'];
				$DATOS['totalLugares'] = 0;
				$DATOS['totalUsuarios'] = 0;
			
				$CIUDADES->agregar($DATOS);

			}		

			//Elimina datos y coleccion
			$GENERICA->eliminaDeTablaTemporal("CIUDADES", array());
			$GENERICA->eliminarColeccion("CIUDADES");
		
			//Una vez cargado el archivo se elimina la carpeta)
			system("rm -Rf " . $CONFIG['PATH']  . "fuentes/ciudades/" . $p . ".txt"); 		
		}



	}

	//Elimina datos y coleccion
	$GENERICA->eliminaDeTablaTemporal("admin1CodesASCII", array());
	$GENERICA->eliminarColeccion("admin1CodesASCII");

}
catch(Exception $e)
{
	$LOG->registra("cargaCiudades", $e->getMessage(), "Ha ocurrido un error. ");
	return false;	
}

?>
