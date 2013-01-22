<?php

	session_start();

	include_once('config.php');
	include_once('clases/Usuarios.php');
	include_once('clases/Utilidades.php');
	include_once('clases/Log.php');		

    $app_id = "182913701726754";
	$app_secret = "d16923f2f43b0a2902bc8900459881ee";

	$mensaje = "";

	if($_GET['app']=='konoce')
		$mensaje="Konoce tu ciudad y disfruta de los mejores eventos de una manera diferente.";
   
?>
﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es"><head>


	<title>Identificarse en Inova 360</title>


		<?php include('bloques/estilos-oauth.php'); ?>
		<?php include('bloques/javascript-oauth.php'); ?>
<style>



#fb-connect {
    background: url("media/imagenes/botones_login_fbtw.png") no-repeat scroll -292px -11px transparent;
    display: block;
    float: left;
    height: 70px;
    width: 250px;
}


.fb-connect-button:before {
    background: url("media/imagenes/sprites.png?v=5") repeat scroll 0 0%, -moz-linear-gradient(#698DA9, #466B8B) repeat scroll 0 0 transparent;
    border-radius: 3px 0 0 3px;
    border-right: 1px solid #456178;
    box-shadow: 0 1px rgba(255, 255, 255, 0.3) inset, 1px 0 0 #89B4DC;
    content: "";
    float: left;
    height: 38px;
    margin-right: 10px;
    width: 45px;
}

.fb-connect-button {
    background: -moz-linear-gradient(#77A9D7, #548BC6) repeat scroll 0 0 transparent !important;
    border: 1px solid #47637A !important;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 1px rgba(255, 255, 255, 0.3) inset, 1px 0 0 #89B4DC, 0 1px 3px #CCCCCC;
    color: #FFFFFF;
    display: block;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
    font-size: 17px !important;
    font-weight: bold;
    height: 40px !important;
    line-height: 38px;
    margin: 0 !important;
    overflow: hidden;
    padding: 0 !important;
    position: relative;
    text-align: left;
    text-shadow: 0 1px #333333 !important;
    width: 100% !important;
}


</style>

</head>
<body>

<div id="fb-root"></div>

<div  id="login">

<form id="frmLogin" method="POST" action="">


<a class="fb-connect-button" href="#" onClick="FacebookInviteFriends(); return false;">Invita a tus amigos de facebook</a>
<br/><br/>
<h1>O invita a tus amigos de Inova360</h1>
<br/>
</form>
<div style="height: 300px; border: 1px solid #666;">

</div>


</div>



<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId:'<?php echo $app_id; ?>',
cookie:true,
status:true,
xfbml:true
});

function FacebookInviteFriends()
{
FB.ui({
method: 'apprequests',
message: '<?php echo $mensaje; ?>'
}, requestCallback);
}

function requestCallback(response) {
alert(response.to);
}
</script>	

</body>
</html>
