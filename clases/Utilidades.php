<?php 

class Utilidades{


	const ACCENT_STRINGS = '���������������������?����I��������������������������?����i��������������';
	const NO_ACCENT_STRINGS = 'SOZsozYYuAAAAAAACEEEEEIIIIIDNOOOOOOUUUUYsaaaaaaaceeeeeiiiiionoooooouuuuyy';
	
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
