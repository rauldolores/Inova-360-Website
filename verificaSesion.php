<?php

	$RESULTADO = array();
	if(isset($_SESSION['ID']))
		$RESULTADO['STATUS'] = "ON";
	else
		$RESULTADO['STATUS'] = "OFF";

	echo json_encode($RESULTADO);

?>
