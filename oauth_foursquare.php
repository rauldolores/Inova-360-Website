<?php	include_once("config.php");	include_once("librerias/php/foursquare/FoursquareAPI.class.php");   $client_key = "OBEE514ZJKDUPTQPT0CM23CMG32OCGTHZJVFMZZ4AXLILROR";   $client_secret = "X2H5Z5H111N1ZOP4TUU13FGELIDYR5TLFCA4JVVS5O1OWV0E";   $my_url = $CONFIG["DOMINIO"] . "/authorize_foursquare.php";   session_start();      $_SESSION['urlRedireccion'] = $_GET['url_redirect'];        $dialog_url = "https://foursquare.com/oauth2/authenticate?client_id=" . $client_key . "&response_type=code&redirect_uri=" . urlencode($my_url) ;     echo("<script> top.location.href='" . $dialog_url . "'</script>");?>