<?php
	include("config.php");
	include("clases/Log.php");
	include("librerias/php/phpmailer/class.phpmailer.php");
	include("clases/Mail.php");

	$contenidoMail = "";
	
	$resultado = false;

	if($_POST)
	{
		foreach($_POST as $key => $value)
		{
				$contenidoMail .= $key . "<br/><br/>" . $value . "<br/><br/>";
		}
		
		$MAIL = new Mail($CONFIG);
		
		$resultado = $MAIL->EnviarCorreo("INOVA360", "raul.dolores@gmail.com", "raul.dolores@gmail.com", "TRABAJO - Inova360", $contenidoMail);
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
	<span style="font-size: 60px;">trabajo</span>
	</div>
		</div>

</div>
	<div id="mission">
		<div class="container">		
					<h3>Somos – <span class="yellow">Inova 360</span> – una empresa enfocada a la incubacion y desarrollo de tecnologias que faciliten nuestras labores diarias, siempre con foco a dejar una huella social. Te invitamos formar parte de nuestro equipo. 
					</h3>		</div>
	</div>
	<div id="homeOptions" class="container" style="margin-top: 0px;">

<br/><br/><br/>	
<h2>Trabaja con nosotros</h2><br/>
<?php
		if($resultado)
			echo "<span class='yellow' style='font-size: 16px;'>Gracias por llenar el formulario. En breve te responderemos.</span>";

?><br/><br/>
<span style="font-size: 28px;color: #4B8EFB;">
Forma parte de un gran proyecto
</span>
<br/><br/><br/>	
<p>	
No lo negamos, aun somos un proyecto que busca dejarlo de ser para pasar a convertirnos en una empresa que impulse la cultura digital y el desarrollo de tecnologia de apoyo en nuestras actividades cotidianas, asi como de tecnologia de mejora de procesos dentro de las pequeñas y medianas empresas.
</p>
<p>
Tenemos una meta por alcanzar y la cual dificilmente la alcanzaremos solos, necesitamos del apoyo de personas que al igual que nosotros esten dispuestos a sacrificar unas horas de su tiempo para alcanzar el exito del proyecto.
</p>
<p>
Al ser apenas un proyecto, aun no generamos ingresos y por lo tanto no podemos ofrecerte por el momento un sueldo a cambio de tu trabajo. Pero si te ofrecemos ser parte de una experiencia en la que llevaremos un proyecto a la constitucion de una empresa y una vez que esto llegue todos podremos obtener beneficios economicos a cambio de desarrollar tecnologia con beneficios para la sociedad.
</p>
<br/><br/>
<span style="font-size: 18px;">
¿Te interesa ser parte de esto?
Tenemos grandes planes para ti.
</span>
<br/><br/><br/>
<span style="font-size: 28px;color: #4B8EFB;">
¿Porque unirte a nuestro proyecto?
</span>
<br/><br/><br/>
<ul>
<li>Seras parte de una experiencia emprendedora</li>
<li>Posibilidad de contratacion en 6 meses</li>
<li>Posibilidad de acceder a acciones una vez que seamos constituidos como empresa</li>
<li>Convivencia con personas apasionada por las tecnologia</li>
<li>Aprendizaje de metodologias y buenas practicas de desarrollo de software</li>
<li>Desarrollaremos tecnologia de punta</li>
<li>No tienes horario, tu decides cuantas horas al dia le aportas al proyecto</li>
<li>Puedes dejar de apoyarnos cuando quieras</li>
</ul>
<br/><br/><br/>
<span style="font-size: 28px;color: #4B8EFB;">
Contesta el siguiente formulario y nos pondremos en contacto contigo:
</span>
<br/><br/><br/>

<form style="color: #4B8EFB; font-size: 20px;" METHOD="POST" ACTION="trabajo.php">
<input type="text" id="txtNombre" name="txtNombre" placeholder="nombre"  style="font-size: 20px; padding: 5px; width: 400px;"><br/>
<input type="date" id="txtEdad" name="txtEdad" placeholder="edad" style="font-size: 20px; padding: 5px; width: 200px;"><br/>
<input type="text" id="txtFacebook" name="txtFacebook" placeholder="Facebook" style="font-size: 20px; padding: 5px; width: 150px;"><br/>
<input type="text" id="txtTwitter" name="txtTwitter" placeholder="Twitter" style="font-size: 20px; padding: 5px; width: 150px;"><br/>
<input type="tel" id="txtTelefono" name="txtTelefono" placeholder="Telefono"  style="font-size: 20px; padding: 5px;"><br/>
<input type="email" id="txtCorreo" name="txtCorreo" placeholder="Email"  style="font-size: 20px; padding: 5px;width: 200px;"><br/>
<input type="text" id="txtCiudad" name="txtCiudad" placeholder="Ciudad" style="font-size: 20px; padding: 5px;"><br/>
<input type="text" id="txtPais" name="txtPais" placeholder="Pais" style="font-size: 20px; padding: 5px;"><br/>
<textarea id="txtPorque" name="txtPorque" style="font-size: 20px; padding: 5px; width: 700px; height: 150px" placeholder="¿Porque quieres unirte a nuestro proyecto?"></textarea><br/><br/>
<textarea id="txtComo" name="txtComo" style="font-size: 20px; padding: 5px; width: 700px; height: 150px" placeholder="¿Como te ves en 3 años?"></textarea><br/><br/>
<textarea id="txtActividades" name="txtActividades" style="font-size: 20px; padding: 5px; width: 700px; height: 150px" placeholder="¿En que actividades consideras que seria el mejor apoyo que nos puedes brindar?"></textarea><br/><br/>
<textarea id="txtHabilidades" name="txtHabilidades" style="font-size: 20px; padding: 5px; width: 700px; height: 150px" placeholder="¿Principales habilidades?"></textarea><br/><br/>
<textarea id="txtExperiencia" name="txtExperiencia" style="font-size: 20px; padding: 5px; width: 700px; height: 150px" placeholder="¿Cuentas con experiencia laboral?¿Cual?"></textarea><br/><br/>
<textarea id="txtInternet" name="txtInternet" style="font-size: 20px; padding: 5px; width: 700px; height: 150px" placeholder="Conocimientos de internet y tecnologias moviles"></textarea><br/><br/>
<input value="Enviar solicitud" type="submit" style="padding: 10px;">
</form>
<br/><br/><br/><br/>
	
	
<?php include('bloques/menu_inferior.php'); ?>		
		
		
	</div>	

<div id="footer" class="container">
Inova 360 &copy; 2012
</div>

</body></html>