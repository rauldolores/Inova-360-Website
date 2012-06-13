<?php 

/*
ESTA CLASE DEBE DE REGISTRAR CON UN HISTORIAL DE 1 MES
PARA EL CASO DE LAS PAGINAS WEB SOLO DEBE DE REGISTRAR LOS ERRORES
PARA EL CASO DE LOS SHELLS DEBE DE REGISTRAR EXITOS Y ERRORES

PARA REGISTRAR EXITOS O ERRORES SE OCUPA LA PROPIEDAD $error

LA CLASE DEBE DE RECOGER TODOS LOS ERRORES ACUMULADOS Y GUARDARLOS AL FINAL DE LA EJECUCION
POR ESO SE DEBE DE OCUPAR UNA CLASE SINGLETON PARA QUE EXISTA UNA SOLA INSTANCIA DE LA CLASE

*/

class Log{

	private $error; //Boolean
	
	function __construct() {
		//
	}

	function registra($clase, $error, $descripcion)
	{
		//Esto es mejor cambiarlo por una coleccion de mongodb
		//Les daria mas flexibilidad y la posibilidad de trabajar con una herramienta de monitoreo
		//esta contemplada
		file_put_contents('/var/www/Desarrollo/Logs/Log.txt', $clase. "\n" . $error . "\n" . $descripcion ,FILE_APPEND); 	
	}
}

?>
