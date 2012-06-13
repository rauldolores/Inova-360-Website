<?php 

class Utilidades{

	
	function limpiarURLCorta($cadena) {
		
		$caracteresNormalizar = array(
    		'�'=>'S', '�'=>'s', '�'=>'Dj','�'=>'Z', '�'=>'z', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
    		'�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I',
    		'�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U',
    		'�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss','�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
    		'�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i',
    		'�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u',
    		'�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b', '�'=>'y', '�'=>'f'
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
