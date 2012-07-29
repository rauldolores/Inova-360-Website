<?php
	include("config.php");
	include("librerias/php/aws/sdk.class.php");

	$contenidoMail = "";
	
	if($_POST)
	{
		foreach($_POST as $key => $value)
		{
				$contenidoMail .= $key . "\n\n" . $value . "\n\n";
		}
		
		$MAIL = new Mail($CONFIG_AWS);
		
		$MAIL->EnviarCorreo("raul.dolores@gmail.com", "CONTACTO - Inova360", $contenidoMail);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<title>Inova 360 - Ideas que cambian el mundo</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	<meta name="keywords" content="diseño web, desarrollo web, php, sitios web, web cuautitlan izcalli, cuautitlan izcalli, estado de mexico, publicidad, publicidad web, seo, twitter, blogs, cms, wordpress, joomla, proveedor web, marketing, listas de correo, mi pagina web, mi sitio web, crear mi web, web gratis, publicidad empresas, publicidad negocios, publicidad antros, publicidad restaurantes, medios sociales">
	<meta name="description" content="INNET ofrece publicidad web para tu empresa o negocio, diseño web, posicionamiento de tu marca, desarrollo de aplicaciones web, y servicios de web parketing para Cuautitlan Izcalli, Estado de Mexico y todo Mexico.">

	<link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="media/css/estilo.css">	
</head>
<body>

<div id="redTemp">
	<div class="container">
		<p>Estadisticas de <a href="estadisticas.php" title="Solicita tu cotizacion">NUESTROS PROYECTOS</a></p>
	</div>
</div>
<div class="container">
		
		<div  class="span-12" style="height: 150px;" >
	<div id="homeHeader" style="float:left"><a href="index.php"><img src="media/imagenes/logo.gif"></a></div>
	<div style="margin-top: 30px; float:right; text-align:right;">	
	<span style="font-size: 16px;"><a href="nuestros_proyectos.php">nuestros proyectos</a> | <a href="ayudame.php">ayudame que yo te ayudare</a></span><br/>
	<span style="font-size: 60px;">contactanos</span>
	</div>
		</div>

</div>
	<div id="mission">
		<div class="container">		
					<h3>Somos – <span class="yellow">Inova 360</span> – una empresa enfocada a la incubacion y desarrollo de tecnologias que faciliten nuestras labores diarias, siempre con foco a dejar una huella social , estamos ubicados en Cuautitlan Izcalli, M&eacute;xico. 
					</h3>		</div>
	</div>
	<div id="homeOptions" class="container" style="margin-top: 0px;">
	
	<div style= "height: 300px; padding: 30px;">

<div class="span-9 content">
<h2>Ponte en contacto con nosotros</h2>
<span>Jardines de la Hda., Cuautitlan Izcalli, Mexico, Mexico</span><br/><br/>
<input type="text" name="name" id="name" placeholder="nombre" style="padding: 5px;"><br/>
<input type="text" name="email" id="email" placeholder="email" style="padding: 5px;"><br/>
<input type="text" name="phone" id="phone" placeholder="telefono" style="padding: 5px;"><br/>
<p><textarea cols="50" rows="10" name="message" id="message" style="padding: 5px;" placeholder="mensaje o razon de contacto"></textarea></p>

<p><input value="Enviar datos" type="submit" style="padding: 10px;"></p>
</div>		
	
	</div>


	<?php include('bloques/menu_inferior.php'); ?>
		
		
		
		
	</div>	

<div id="footer" class="container">
Inova 360 &copy; 2012
</div>

</body></html>