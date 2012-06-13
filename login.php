<?php

session_start();

include_once('config.php');
include_once('clases/Usuarios.php');
include_once('clases/Log.php');		

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
			$USUARIO = new Usuarios();		
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

<div  id="login">

<form id="frmLogin" method="POST" action="">
    <h1>Entra a tu cuenta <img src="media/imagenes/logo.gif" height="40" width="115"></h1>
<?php if($mensaje != ""){ ?>
<div style="padding: 20px; width: 360px;;" class="warning">
<?php echo $mensaje ?>
</div>
<?php } ?>
    <fieldset id="inputs">
        <input id="email" name="email" type="email" placeholder="Email" autofocus required>
        <input id="password" name="password" type="password" placeholder="Password" required><br/>
	<input id="recordar" name="recordar" value="1" type="checkbox" style="width: auto;"> <label for = "recordar">No cerrar sesi&oacute;n</label>
    </fieldset>
    <fieldset id="actions">
        <input type="submit" id="submit" class="submit" value="Entrar">
        <a href="">&iquest;No puedes entrar a tu cuenta?</a><br/>
	<a href="" class="negritas">Crear una cuenta gratuita</a>
    </fieldset>
</form>

<br/><br/>
<a id="fb-connect" class="login-btn" href="/oauth_fb.php"></a>

</div>




</body>
</html>
