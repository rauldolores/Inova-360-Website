<?php

session_start();

include_once('config.php');
include_once('clases/Usuarios.php');
include_once('clases/Utilidades.php');
include_once('clases/Log.php');		

   $app_id = "182913701726754";
   $app_secret = "d16923f2f43b0a2902bc8900459881ee";
   $my_url = "http://www.inova360local.com/login?client_id=" . $_GET['client_id'] . "&scope=" . $_GET['scope'] . "&status=" . $_GET['status'] . "&response_type=" . $_GET['response_type'];
   $code = $_GET['code'];
   
   $USUARIO = new Usuarios();	

	if(isset($_SESSION['state']) && isset($_REQUEST['state']))
	{
	
	   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
			 // state variable matches
			 $token_url = "https://graph.facebook.com/oauth/access_token?"
			   . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
			   . "&client_secret=" . $app_secret . "&code=" . $code;

			 $response = file_get_contents($token_url);
			 $params = null;
			 parse_str($response, $params);
			 
			 $_SESSION['access_token'] = $params['access_token'];

			 $graph_url = "https://graph.facebook.com/me?access_token=" . $params['access_token'];
			 $user = json_decode(file_get_contents($graph_url));
			 
			 $datosFecha = explode("/",$user->birthday);
			 
			 $graph_url2 = "https://api.facebook.com/method/fql.query?query=SELECT%20current_location%20FROM%20user%20WHERE%20uid=4&access_token=" . $params['access_token'];
			 $user2 = json_decode(file_get_contents($graph_url2));
			 
			 $UTILIDADES = new Utilidades();	
			 
			
			$CONDICION_BUSQUEDA = array();
			$CONDICION_BUSQUEDA['facebookUsuario']=$user->username;
			$resultadoBusqueda = $USUARIO->obtenerUsuarioFiltros($CONDICION_BUSQUEDA);

			//Nuca se ha firmado con facebook
			if($resultadoBusqueda == "")
			{
				//buscar por email
				unset($CONDICION_BUSQUEDA);
				$CONDICION_BUSQUEDA = array();
				$CONDICION_BUSQUEDA['email']=$user->email;
				$resultadoBusqueda = $USUARIO->obtenerUsuarioFiltros($CONDICION_BUSQUEDA);
				
				//No esta registrado el usuario en Inova 360
				if($resultadoBusqueda == "")
				{
					//se agrega el usuario y login
					$DATOS = array();
					$DATOS['nombre']=$user->first_name;
					$DATOS['apellidos']=$user->last_name;
					$DATOS['email']=$user->email;
					$DATOS['password']="";
					$DATOS['fechaCreacion']=time();
					$DATOS['facebookUsuario']=$user->username;
					$DATOS['fechaNacimiento']=$datosFecha[1] . "/" . $datosFecha[0] . "/" . $datosFecha[2];
					$DATOS['pais']=$user2->hometown_location->country;
					$DATOS['ciudad']=$UTILIDADES->limpiarURLCorta($user->hometown);
					$DATOS['genero']= ($user->gender == "male") ? "H":"M";

					$idUsuario = $USUARIO->agregar($DATOS);	 				
					$USUARIO->forzarLogin($idUsuario);
					
					header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");
				}
				//Ya esta registrado el usuario pero no tiene una cuenta de facebook asociada
				else
				{
					//se relaciona el usuario de facebook con la cuenta inova360 y login
					$DATOS = array();
					$DATOS['facebook_usuario']=$user->username;

					$CONDICION = array();
					$CONDICION['_id'] = new MongoId($resultadoBusqueda['_id']);

					$idUsuario = $USUARIO->editar($CONDICION, $DATOS);	 				
					$USUARIO->forzarLogin($resultadoBusqueda['_id']);
					
					header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");					
				}
			}
			//Se ha firmado con facebook anteriormente
			else
			{
				//actualizo los datos y login
				$USUARIO->forzarLogin($resultadoBusqueda['_id']);
				header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");									
			}
		
		
	   }

	}

if(!isset($_GET['client_id']) || !isset($_GET['scope']) || !isset($_GET['status']) || !isset($_GET['response_type']))
	die("Error");

if(isset($_SESSION['ID'])) 
	header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");

$mensaje = "";

try{
		
	if(isset($_POST['email']))
	{
		$LOG = new Log();
		try
		{
			
			$USUARIO->email = $_POST['email'];
			$USUARIO->password = $_POST['password'];
			$USUARIO->CONFIG = $CONFIG;

			if(!$USUARIO->login())
				$mensaje = "El usuario o el password no existen. Por favor, revisa los datos.";
			else{
				header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");
			}				


		}
		catch(Exception $e)
		{
			$LOG->registra("Login", $e->getMessage(), "Ocurrio un error al intentar firmarse con el usuario " . $email);
			$mensaje = "Ocurrio un error al intentar firmarse. Intentelo nuevamente mas tarde.";
		}
	}				

}catch(Exception $e){
	$LOG->registra("Login", $e->getMessage(), "Ocurrio un error al intentar firmarse con el usuario " . $email);
}



?>
﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es"><head>


	<title>Identificarse en Inova 360</title>


		<?php include('bloques/estilos-oauth.php'); ?>
		<?php include('bloques/javascript-oauth.php'); ?>
<style>




#inputs input
{
    background: #f1f1f1 url(media/imagenes/login-sprite.png) no-repeat;
    padding: 15px 15px 15px 30px;
    margin: 0 0 10px 0;
    width: 353px; /* 353 + 2 + 45 = 400 */
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
}


#fb-connect {
    background: url("media/imagenes/botones_login_fbtw.png") no-repeat scroll -292px -11px transparent;
    display: block;
    float: left;
    height: 70px;
    width: 250px;
}


</style>

</head>
<body>
<div id="fb-root"></div>
<script>
/*
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '182913701726754', // App ID
      channelUrl : '//www.konocelocal.com/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here

  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
   
function login() {

	// Additional init code here
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			// connected
			testAPI();
		} else if (response.status === 'not_authorized') {
			// not_authorized
			ventanaLogin();
			alert('b');
		} else {
			// not_logged_in
			ventanaLogin();
			alert('c');
		}
	});
}

function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Good to see you, ' + response.email + '.');
    });
}

function ventanaLogin()
{
    FB.login(function(response) {
        if (response.authResponse) {
            // connected 
			alert('conectado');
        } else {
            // cancelled
			alert('no conectado');
        }
    });
}


// Additional init code here
/*FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
        // connected
    } else if (response.status === 'not_authorized') {
        // not_authorized
        login();
    } else {
        // not_logged_in
        login();
    }
});
};*/
</script>

<div  id="login">

<form id="frmLogin" method="POST" action="">

    <h1><img src="media/imagenes/logo.gif" height="80" width="230"><br>Entra a tu cuenta</h1>
<?php if($mensaje != ""){ ?>
<div style="padding: 20px; width: 360px;;" class="warning">
<?php echo $mensaje ?>
</div>
<?php } ?>
    <fieldset id="inputs">
        <input id="email" name="email" type="email" placeholder="Email" autofocus required>
        <input id="password" name="password" type="password" placeholder="Password" required><br/>
	<input id="recordar" name="recordar" value="1" type="checkbox" style="width: auto;"> <label for = "recordar">Mantener la sesi&oacute;n</label>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" class="submit" value="Entrar">
        <a href="registro?client_id=<?php echo $_GET['client_id']; ?>&scope=<?php echo $_GET['scope']; ?>&status=<?php echo $_GET['status']; ?>&response_type=<?php echo $_GET['response_type']; ?>" style="font-size: 14px;">&iquest;No puedes entrar a tu cuenta?</a><br/>
	<a href="registro?client_id=<?php echo $_GET['client_id']; ?>&scope=<?php echo $_GET['scope']; ?>&status=<?php echo $_GET['status']; ?>&response_type=<?php echo $_GET['response_type']; ?>" class="negritas" style="font-size: 14px;">Crear una cuenta gratuita</a>
    </fieldset>
</form>

<br/><br/>
<a id="fb-connect" class="login-btn" href="/oauth_fb.php?client_id=<?php echo $_GET['client_id']; ?>&scope=<?php echo $_GET['scope']; ?>&status=<?php echo $_GET['status']; ?>&response_type=<?php echo $_GET['response_type']; ?>" ></a>

</div>




</body>
</html>
