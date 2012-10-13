<?php 

class Utilidades{


	const ACCENT_STRINGS = 'ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊË?ÌÍÎÏIÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêë?ìíîïiðñòóôõöøùúûüýÿ';
	const NO_ACCENT_STRINGS = 'SOZsozYYuAAAAAAACEEEEEIIIIIDNOOOOOOUUUUYsaaaaaaaceeeeeiiiiionoooooouuuuyy';
	
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
	
	
	static public function accentToRegex($text)
	{
		$from = str_split(self::ACCENT_STRINGS);
		$to   = str_split(strtolower(self::NO_ACCENT_STRINGS));
		$text = utf8_decode($text);
		$regex = array();

		foreach ($to as $key => $value)
		{
			if (isset($regex[$value]))
			{
				$regex[$value] .= $from[$key];
			} else {
				$regex[$value] = $value;
			}
		}

		foreach ($regex as $rg_key => $rg)
		{
			$text = preg_replace("/[$rg]/", "_{$rg_key}_", $text);
		}

		foreach ($regex as $rg_key => $rg)
		{
			$text = preg_replace("/_{$rg_key}_/", "[$rg]", $text);
		}

		return utf8_encode($text);

	}	
	
	
	function makeRandomString($max=6) 
	{
		$i = 0; //Reset the counter.
		$possible_keys = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$keys_length = strlen($possible_keys);
		$str = ""; //Let's declare the string, to add later.
		while($i<$max) {
			$rand = mt_rand(1,$keys_length-1);
			$str.= $possible_keys[$rand];
			$i++;
		}
		return $str;
	}	
}




?>
