<?php
	
	include_once "../../clases/Inova360API.inc.php";

	$TOKEN = "";
	$CONSUMIDOR = "";

	if(isset($_POST['token']))
	{
		$TOKEN = (isset($_POST['token']))?$_POST['token']: '';
		$CONSUMIDOR = (isset($_POST['client_id']))?$_POST['client_id']: '';;
	}else{
		$TOKEN = (isset($_GET['token']))?$_GET['token']: '';
		$CONSUMIDOR = (isset($_GET['client_id']))?$_GET['client_id']: '';;
	}

	if($TOKEN == '' || $CONSUMIDOR == '')
		die('Error');

	//Validar permisos
	$API = new Inova360API();
	$DATOS = $API->getAccessToken($TOKEN);
	if(!$DATOS || $DATOS['consumidorId'] != $CONSUMIDOR)
	

	//Regresar valores
	$RESPUESTA = array();
	$RESPUESTA['valor']='prueba';

	echo json_encode($RESPUESTA);

?>
