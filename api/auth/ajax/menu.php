<?php	

	session_start();
	include_once("../../../config.php");
	include_once("../../../clases/Usuarios.php");
	include_once("../../../clases/Cookie.php");		
	include_once("../../../clases/Sesion.php");

	Sesion::forzarAbrirSesion();

	header("Content-Type: text/javascript");

	ob_start();

?>
	<div style="float:left;">
	<ul>
	  <li class="singleLinkCliqoo"><img src="<?php echo $CONFIG["DOMINIO"]; ?>api/auth/imagenes/cliqoo.png">&nbsp;&nbsp;&nbsp;</li>
	  <li class="singleLinkCliqoo"><a target="_blank" href="#">Ideas que cambian al mundo</a></li>
	  <!--
	  <li class="singleLinkCliqoo"><a target="_blank" href="http://orkut.com">Oficina</a></li>
	  <li class="singleLinkCliqoo"><a target="_blank" href="http://gmail.com">Escuela</a></li>
	  <li class="singleLinkCliqoo"><a target="_blank" href="https://www.google.com/calendar">Calle</a></li>
	  <li>
		<a href="#">Mas<span class="arrow"></span></a>

		<ul>
			<li><a href="http://www.google.co.in/reader">Educacion</a></li>
			<li><a href="https://sites.google.com">Trabajo</a></li>
			<li><a href="http://groups.google.co.in">Groups</a></li>
			<li><a href="http://www.youtube.com">Ventas</a></li>
			<li>
			<div class="mid-line">
			</div>
			</li>
			<li><a href="http://www.google.co.in/imghp?hl=en&tab=wi">Calendario</a></li>
			<li><a href="http://maps.google.co.in/maps?hl=en&tab=wl">Mapas</a></li>
			<li><a href="http://translate.google.co.in/">Traduccion</a></li>
			<li><a href="http://books.google.co.in">Libros</a></li>
			<li><a href="http://blogsearch.google.co.in">Blogs</a></li>
			<li>
			<div class="mid-line">
			</div>
			</li>
			<li><a href="http://www.google.co.in/intl/en/options/">Configurar menus >></a></li>
			<li>
			<div class="mid-line">
			</div>
			</li>
		</ul>
	  </li>-->
	</ul>
	</div>
		<div style="float:right; font-weight: bold;">
	<ul>
	<?php
		if(isset($_SESSION['ID']))
		{		
	?>
		<?php 

		$genero = ($_SESSION['GENERO']=='H')?"male":"female";
		$imagen_usuario=$CONFIG["DOMINIO"] . "media/imagenes/user_" . $genero . "_medium.png";
		if(isset($_SESSION['IMAGEN_THUMB']))
		{
			
		}
		?>
		<li class="singleLinkCliqoo"><img src="<?php echo $imagen_usuario?>" height="25" width="25" style="background-color:#999;">&nbsp;&nbsp;&nbsp;</li>
		<li class="singleLinkCliqoo"><a style="cursor: pointer;" href="perfil.php"><?php echo $_SESSION['NOMBRE']; ?></a></li>
		<li class="singleLinkCliqoo"><a style="cursor: pointer;" onClick="muestraLogin();">Configuracion</a></li>
		<li class="singleLinkCliqoo"><a style="cursor: pointer;" onClick="logout();">Salir</a></li>
		<li class="singleLinkCliqoo">
			<span>

			</span>		
		</li>		
		
	<?php
		}else{
	?>
	  <li class="singleLinkCliqoo"><a class="lightboxCLIQOO punteroCLIQOO" href="registro?client_id=<?php echo $_GET['client_id'] ?>&scope=<?php echo $_GET['scope'] ?>&status=<?php echo $_GET['status'] ?>&response_type=<?php echo $_GET['response_type'] ?>">Registrate</a></li>
	  <li class="singleLinkCliqoo"><a class="punteroCLIQOO" href="login?client_id=<?php echo $_GET['client_id'] ?>&scope=<?php echo $_GET['scope'] ?>&status=<?php echo $_GET['status'] ?>&response_type=<?php echo $_GET['response_type'] ?>">Ingresa a tu cuenta</a></li>
	<?php
		}
	?>

	<li class="singleLinkCliqoo"><a href="javascript: return false;" >&nbsp;</a></li>
	  
	  
	</ul>
	</div>
	

<?php
	$codigo = ob_get_contents();
	ob_end_clean();
	echo $_GET['callback'] . "(" . json_encode($codigo) . ")";
?>
