<?php
	include_once("config.php");
	include_once("clases/Usuarios.php");

	session_start();

   $client_key = "OBEE514ZJKDUPTQPT0CM23CMG32OCGTHZJVFMZZ4AXLILROR";
   $client_secret = "X2H5Z5H111N1ZOP4TUU13FGELIDYR5TLFCA4JVVS5O1OWV0E";	
   $my_url = $CONFIG["DOMINIO"] . "authorize_foursquare.php";
	
	//header("Location:" . $CONSUMIDOR['urlRedireccionar']);
	 $token_url = "https://foursquare.com/oauth2/access_token?client_id=" . trim($client_key) . "&client_secret=" . trim($client_secret) . "&grant_type=authorization_code&redirect_uri=" . urlencode( trim($my_url) ) . "&code=" . trim($_GET['code']);

	 $response = file_get_contents($token_url);
	 $params = null;
	 parse_str($response, $params);

	 $USUARIOS = new Usuarios();
	 
	 //AQUI GRABAR EL TOKEN EN LA BD Y ASOCIARLA AL USUARIO
	
	$CONDICION = array();
	$CONDICION['_id'] = new MongoId($_SESSION["ID"]);	 
	 
	 $USUARIOS->editar($CONDICION, array("foursquare_token" => $params['access_token']));
	 
	 $_SESSION['access_token_foursquare'] = $params['access_token'];	

	 
	 header("Location: " . $_SESSION['urlRedireccion'] . "?login=ok");
?>