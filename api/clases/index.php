<?php

		//Primero hacer una validacion que no esten haciendo spam, por ahorita no importa pero aqui se va a modificar mas adelante que se abra el api a la gente

		//INCLUDES DE TODAS LAS CLASES
		//
		//
		//

		$clase = $_POST["clase"];
		$metodo = $_POST["metodo"];
		
		$argumentos = $_POST["argumentos"];
		$temporalArgs = json_decode($argumentos);
		$argsUTF8 = array_utf8_encode_recursive($temporalArgs);
		
		if (class_exists($clase)) 
		{
			if($clase != "BaseDatos" && $clase != "Cache")
			{
				//Creamos la instacia de la clase
				if($clase == "Lugares")
					$objeto = new Lugares();
				elseif($clase == "Usuarios")
					$objeto = new Usuarios();
					
				//Invocamos el metodo
				if(method_exists($objeto, $metodo) && is_callable(array($objeto, $metodo)))
				{
					$datos = call_user_func_array(array($objeto, $metodo), $argsUTF8); 
				}else{
					//registra el log "Intento de uso de metodo prohibido"
					//registrar ip y datos para bloquear
				}
				
			}else{
				
				//registra el log "Intento de entrar a clase prohibida"
				//registrar ip y datos para bloquear
			}
		}else{
			//registra el log "Intento de invocar a clase que no existe"
			//registrar ip y datos para bloquear
		}


		$datosResultado = json_encode(array_utf8_encode_recursive($datos));
	
		echo $datosResultado;
	
	
		function array_utf8_encode_recursive($dat)
        { if (is_string($dat)) {
            return utf8_encode($dat);
          }
          if (is_object($dat)) {
            $ovs= get_object_vars($dat);
            $new=$dat;
            foreach ($ovs as $k =>$v)    {
                $new->$k=array_utf8_encode_recursive($new->$k);
            }
            return $new;
          }
         
          if (!is_array($dat)) return $dat;
          $ret = array();
          foreach($dat as $i=>$d) $ret[$i] = array_utf8_encode_recursive($d);
          return $ret;
        }
		
		
		function array_utf8_decode_recursive($dat)
        { if (is_string($dat)) {
            return utf8_decode($dat);
          }
          if (is_object($dat)) {
            $ovs= get_object_vars($dat);
            $new=$dat;
            foreach ($ovs as $k =>$v)    {
                $new->$k=array_utf8_decode_recursive($new->$k);
            }
            return $new;
          }
         
          if (!is_array($dat)) return $dat;
          $ret = array();
          foreach($dat as $i=>$d) $ret[$i] = array_utf8_decode_recursive($d);
          return $ret;
        } 	

?>