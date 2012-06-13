<?php 

class Utilidades{

	
	function limpiarURLCorta($cadena) {
		
		$caracteresNormalizar = array(
    		'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    		'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
    		'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    		'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    		'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    		'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    		'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
		);		
		
		$cadena = strtolower(utf8_decode($cadena));
	    	$cadena = str_replace('&', '-y-', $cadena);
	    	$cadena = trim(preg_replace('/[^\w\d_ -]/si', '', $cadena));
	    	$cadena = str_replace(' ', '-', $cadena);
	    	$cadena = str_replace('--', '-', $cadena);
	   
	    	return strtr($cadena, $caracteresNormalizar);
	}	
	
	function descargarArchivoRemoto($url, $destino)
	{ 
		$contenido = file_get_contents($url);
		file_put_contents($destino, $contenido);	
	}
	
}

?>
