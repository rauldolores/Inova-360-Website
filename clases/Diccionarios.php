<?php 

include_once("Log.php");

class Diccionarios{

	public $nombre;
	public $directorio;
	
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->LOG = new Log();
	}
	

	function crear($directorio, $nombre)
	{	
		try
		{
			if(!file_exists($directorio . $nombre))
			{	
				$manejador = fopen($directorio . $nombre, 'x+');
				fclose($manejador);
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Diccionarios", $e->getMessage(), "No se puede crear el diccionario " . $directorio . $nombre);
			return false;	
		}
		return true;
	}
	
	function borrar($directorio, $nombre)
	{
		
		try
		{
			if(file_exists($directorio . $nombre))
			{	
				unlink($directorio . $nombre);				
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Diccionarios", $e->getMessage(), "No se puede eliminar el diccionario " . $directorio . $nombre);
			return false;	
		}
		return true;
	}

	function lista($directorio)
	{
		$archivos = array();
		try
		{		
			if(is_dir($directorio))
			{  
      			if($gd = opendir($directorio))
      			{  
         			while(($archivo = readdir($gd)) !== false)
         			{  
            			if(!is_dir($archivo))
            			{  
               				$archivos[] = $archivo; 
            			} 
         			} 
      			} 
   			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Diccionarios", $e->getMessage(), json_encode($DATOS));
			return false;	
		}			
		return $archivos;
	}	
	
	function agregarPalabra($directorio, $diccionario, $palabra, $traduccion)
	{
		$traduccion = utf8_encode($traduccion);
		try{
			$palabras = $this->cargar($directorio . $diccionario);
			$palabras[$palabra]=$traduccion;
			
			$contenido = array();
			foreach($palabras as $id => $valor)
			{
				$contenido[] = $id . "=" . $valor;
			}
			
			$datos = implode("\n", $contenido);
			
			if(is_writable($directorio . $diccionario))
			{
				$fh = fopen($directorio . $diccionario, 'w');			
				if(fwrite($fh, $datos) === FALSE)
				{
					$this->LOG->registra("Diccionarios", "", "No es posible gabrar las palabras ");
					return false;
				}
				fclose($fh);			
			}
				
		}catch(Exception $e){
			$this->LOG->registra("Diccionarios", $e->getMessage(), "No es posible agregar la palabra " . $palabra . " en el archivo " . $directorio . $diccionario);
			return false;			
		}
		return true;		
	}
	
	function eliminarPalabra($directorio, $diccionario, $palabra)
	{
		try{
			$palabras = $this->cargar($directorio . $diccionario);
			unset($palabras[$palabra]);
			
			$contenido = array();
			foreach($palabras as $id => $valor)
			{
				$contenido[] = $id . "=" . $valor;
			}
			
			$datos = implode("\n", $contenido);
			
			if(is_writable($directorio . $diccionario))
			{
				$fh = fopen($directorio . $diccionario, 'w');
				if(fwrite($fh, $datos) === FALSE)
				{
					$this->LOG->registra("Diccionarios", "", "No es posible gabrar las palabras ");
					return false;
				}
				fclose($fh);
			}			
				
		}catch(Exception $e){
			$this->LOG->registra("Diccionarios", $e->getMessage(), "No es posible eliminar la palabra " . $palabra . " en el archivo " . $directorio . $diccionario);
			return false;			
		}
		return true;
	}	
	
	function cargar($archivo)
	{
		$diccionario = array();
		try{
			$lineas = file($archivo);
			foreach($lineas as $linea)
			{	
				$palabra = explode("=", trim($linea));
				$diccionario[$palabra[0]] = $palabra[1];
			}
		}catch(Exception $e){
			$this->LOG->registra("Diccionarios", $e->getMessage(), json_encode($archivo));
			return false;					
		}
		return $diccionario;
	}
	
	
}

?>
