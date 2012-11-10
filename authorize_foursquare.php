<?php
	session_start();

   $client_key = "OBEE514ZJKDUPTQPT0CM23CMG32OCGTHZJVFMZZ4AXLILROR";
   $client_secret = "X2H5Z5H111N1ZOP4TUU13FGELIDYR5TLFCA4JVVS5O1OWV0E";	
	
	//header("Location:" . $CONSUMIDOR['urlRedireccionar']);
	 $token_url = "https://foursquare.com/oauth2/access_token
					?client_id=" . $client_key . "
					&client_secret=" . $client_secret . "
					&grant_type=authorization_code
					&redirect_uri=" . $_SESSION['urlRedireccion'] . "
					&code=" . $_GET['code'];


	 $response = file_get_contents($token_url);
	 $params = null;
	 parse_str($response, $params);
	 
	 //AQUI GRABAR EL TOKEN EN LA BD Y ASOCIARLA AL USUARIO
	 
	 $_SESSION['access_token'] = $params['access_token'];	

	 
	 header("Location: " . $_SESSION['urlRedireccion'] . "?login=ok");
?>