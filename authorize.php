<?php
session_start();

include_once "clases/Inova360API.inc.php";
include_once "clases/Cookie.php";
include_once "clases/Usuarios.php";
include_once "clases/Consumidores.php";
include_once "clases/Sesion.php";

$INOVA360 = new Inova360API();

if(!isset($_GET['client_id']) || !isset($_GET['scope']) || !isset($_GET['status']) || !isset($_GET['response_type']) )
	die("Error");

$CONSUMIDORID = $_GET['client_id'];
$ALCANCE = $_GET['scope'];
$ESTATUS =  $_GET['status'];
$TIPO_RESPUESTA =  $_GET['response_type'];

//Si no existe session intentamos volverla a abrir desde cookies. Es necesario haber invocado antes a session_start()
Sesion::forzarAbrirSesion();


//Si existe una session abierta
if(isset($_SESSION['ID']))
{
	//Obtenemos el registro del token correspondiente a un usuario y un consumidor
	$existePermisoParaConsumidor = $INOVA360->validarConsumidor($CONSUMIDORID, $_SESSION['ID']);

	if($existePermisoParaConsumidor)
	{ 
		$CONSUMIDORES = new Consumidores();
		$FILTRO = array("_id" => new MongoId($CONSUMIDORID));
		$CONSUMIDOR = $CONSUMIDORES->obtenerConsumidor($FILTRO);

		$TOKEN = $INOVA360->obtenerToken($CONSUMIDORID, $_SESSION['ID']);

		//Si el consumidor tiene acceso total a el API (Solo sitios propios)
		if($CONSUMIDOR['accesoTotal']=='V')
		{			
			//Se genera un nuevo token
			$INOVA360->crearToken($CONSUMIDORID, "all");
			//Se redirecciona a la URL registrada

			header("Location:" . $CONSUMIDOR['urlRedireccionar']);

		}
		else
		{
			//Se valida si el consumidor tiene permisos para este usuario
			if($INOVA360->checkScope(explode(",",$TOKEN['alcance']), explode(",",$ALCANCE)))
			{
				//Se genera un nuevo token
				$INOVA360->crearToken($CONSUMIDORID, $ALCANCE);
				//Se redirecciona a la URL registrada

				header("Location:" . $CONSUMIDOR['urlRedireccionar']);			
			}else{
				//Continuamos con la aplicacion mostrando el codigo html y el form de autorizacion
			}

		}
	}
}
else
{
	header("Location: login?client_id=$CONSUMIDOR&scope=$ALCANCE&status=$ESTATUS&response_type=$TIPO_RESPUESTA");
}

//Si se pulsa el boton de autorizar
if ($_POST) {
	$INOVA360->finishClientAuthorization($_POST["accept"] == "Autorizar", $_POST);
}

//Se obtienen la lista de permisos solicitados
$_GET['client_id'] = new MongoId($_GET['client_id']);
$alcanceSolicitado = $INOVA360->getAuthorizeParams();


?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
<title>Autorizador</title>
		<?php include('bloques/estilos-oauth.php'); ?>
		<?php include('bloques/javascript-oauth.php'); ?>
</head>		
<body>
	<div id="autorizacion">
	    <form method="post" action="">
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['ID'] ?>" />
		    <?php foreach ($alcanceSolicitado as $k => $v) { ?>
		    	<input type="hidden" name="<?php echo $k ?>" value="<?php echo $v ?>" />
		    <?php } ?>
			<span class="fuente25">
		      &iquest;Autorizas a Konoce para que accese a los datos de tu cuenta?
			</span><br/><br/><br/>			
			<span class="fuente15 negritas">Tendra acceso a:</span> <br/><br/>
			<span class="fuente15">
			<?php foreach ($alcanceSolicitado as $k => $v) { ?>
				<?php
				if($k == "scope")
				{
					$valores = explode(",", $v);
					foreach($valores as $alcance)
					{
						
						echo ($alcance=="general_information")?"Modificar y leer tu informacion general.":"";
						echo ($alcance=="contact_information")?"Modificar y leer tu informacion de contacto.":"";
						echo ($alcance=="education_information")?"Modificar y leer tu informacion escolar.":"";
						echo ($alcance=="work_information")?"Modificar y leer tu informacion laboral.":"";
						echo ($alcance=="location")?"Modificar y leer informacion sobre tu ubicacion.":"";
						echo ($alcance=="user_media")?"Modificar y leer informacion de tus fotos, videos y musica.":"";
						echo ($alcance=="all")?"Todos los datos de tu cuenta.":"";
						echo ($alcance=="stream")?"Modificar y leer linea de tiempo.":"";
						echo ($alcance=="events")?"Modificar y leer informacion de eventos.":"";
						echo ($alcance=="user_friends")?"Modificar y leer informacion de tus listas de amigos":"";
						echo ($alcance=="interests")?"Modificar y leer informacion de intereses personales.":"";
						echo ($alcance=="mailbox")?"Crear y leer mensajes de tu buzon.":"";
						echo ($alcance=="notifications")?"Crear y leer tus notificaciones.":"";
						echo "<br/>";
					}
				}
				?>
			<?php } ?>
			</span><br/><br/>
		      <p>
			<input type="submit" class="submit" name="accept" value="Autorizar" />
			<input type="submit" name="accept" value="No gracias" />
		      </p>

			<p class="fondoOscuro">
			Algunos de tus amigos ya utilizan esta aplicacion: <br/><br/><br/>
			</p>
			<p class="fondoOscuro">
				En cualquier momento, puedes revocar el acceso a cualquier aplicaci&oacute;n desde <a href="#">la lista de aplicaciones</a> de tu p&aacute;gina de configuraci&oacute;n.<br/><br/>
				Al autorizar una aplicaci&oacute;n, continuar&aacute;s operando bajo las <a href="#">Condiciones de Servicio de Inova360</a>. En concreto, algunos datos de uso ser&aacute;n compartidos con Inova360. Para m&aacute;s informaci&oacute;n, consulta nuestra <a href="#">Pol&iacute;tica de Privacidad</a>.
			</p>
	    </form>
	</div>
</body>
</html>