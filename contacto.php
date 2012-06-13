<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es"><head>


	<title>Contacto - Publicidad web, Diseño web, Desarrollo web, Hosting y manejo de contenido - Insight Networks - Cuautitllan Izcalli, Estado de Mexico</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	<meta name="keywords" content="contactanos,forma de contacto, diseño web, desarrollo web, php, sitios web, web cuautitlan izcalli, cuautitlan izcalli, estado de mexico, publicidad, publicidad web, seo, twitter, blogs, cms, wordpress, joomla, proveedor web, marketing, listas de correo, mi pagina web, mi sitio web, crear mi web, web gratis, publicidad empresas, publicidad negocios, publicidad antros, publicidad restaurantes, medios sociales">
	<meta name="description" content="Pagina de contacto. INNET ofrece publicidad web para tu empresa o negocio, diseño web, posicionamiento de tu marca, desarrollo de aplicaciones web, y servicios de web parketing para Cuautitlan Izcalli, Estado de Mexico y todo Mexico.">

<?php include("includes.php"); ?>


<link rel="stylesheet" href="scripts/js/jquery/themes/default/ui.all.css" type="text/css" media="screen" title="Flora (Default)" />
<script type="text/javascript" src="scripts/js/jquery/jquery-1.2.6.js"></script>		

<script type="text/javascript" src="scripts/js/jquery/ui/ui.core.js"></script>
<script type="text/javascript" src="scripts/js/jquery/ui/ui.dialog.js"></script>



<script>




function dialogo(html){

	$('#dialog').html(html);
	$('#dialog').css('font-size', '20px');
	$('#dialog').show();

	$("#dialog").dialog({ 
		bgiframe: true,
		modal: true, 
		width: 600,
		height: 220,
		title: "Aviso",
		autoclose: false,
		close: false,
	    overlay: { 
	        opacity: 0.5, 
	        background: "black" 
	    } ,

	    buttons: { 
		    "Aceptar": function() { 
	            $(this).dialog("close"); 
	        } 
	    } 
	});

	$('#dialog').dialog("open");

}

</script>


<script language="JavaScript" type="text/JavaScript">

	function sendEmail(){
		$.post(
			"ajax/send_email.ajax.php",
			{mailto: 'info@insight-networks.net', mailfrom: $('#email').val(), namefrom: $('#business').val()+'-'+$('#name').val(), subject: 'Contacto [Insight Networks]', message: $('#business').val()+' - '+$('#name').val()+'<br>'+$('#email').val()+'<br>'+$('#phone').val()+'<br><br><br>'+$('#message').val()},
			function(data){

				var formulario = data;
				dialogo(data);
			}
		);
	}
</script>

</head><body>
<div id="dialog" style="display: none;"></div>

<div class="container">
<?php include("header.php"); ?>


</div>
<hr>
<div class="container">


	<div class="span-12 main">
<div class="members view span-6">
	<h2 >Contactanos</h2>
	<div id="teaser"><p>Envianos tu proyecto</p></div>
</div>
<div class="span-6 last">


</div>
<div class="span-9 content">
<h3>Nombre</h3>
<p><input type="text" name="name" id="name"></p>
<h3>Empresa</h3>
<p><input type="text" name="business" id="business"></p>
<h3>Email</h3>
<p><input type="text" name="email" id="email"></p>
<h3>Telefono</h3>
<p><input type="text" name="phone" id="phone"></p>
<h3>Mensaje</h3>
<p><textarea cols="50" rows="10" id="message"></textarea></p>

<p><input value="Enviar datos" type="button" onClick="sendEmail(); return false;"></p>


</div>	
	
		<div id="sidebar" class="span-3 last">		

<div class="pageSidebars">

</div>
<div class="categorySidebars">
</div>
	
		</div> 
	</div>
<?php include("footer.php"); ?>

	</div>
</div>
<?php include("googleanalytics.php"); ?>
</body></html>