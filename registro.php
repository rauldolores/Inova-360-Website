<?php

session_start();

include_once('config.php');
include_once('clases/Usuarios.php');
include_once('clases/Paises.php');
include_once('clases/Ciudades.php');
include_once('clases/Log.php');		

if(!isset($_GET['client_id']) || !isset($_GET['scope']) || !isset($_GET['status']) || !isset($_GET['response_type']))
	die("Error");

if(isset($_SESSION['ID'])) 
	header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");

$mensaje = "";

//try{
		
	if(isset($_POST['txtNombre']))
	{
		$LOG = new Log();


		$USUARIO = new Usuarios();
		$PAIS = new Paises();
		$CIUDAD = new Ciudades();
		
		//AQUI SE DEBEN DE HACER TODAS LAS VALIDACIONES ANTES DE HACER LA INSERCION
		$VALIDACION = true;
		
		
		if(!isset($_POST['chkCondiciones']))
		{
			$mensaje = "Es necesario aceptar las condiciones.";
			$VALIDACION = false;			
		}
		
		//SE DEBE VALIDAR LA FECHA, EL CORREO, Y EL GENERO
		if(filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL) == FALSE)
		{
			$mensaje = "Es necesario que se introduzca una direccion de correo valida.";
			$VALIDACION = false;
		}

		if(strtoupper($_POST['txtGenero']) != 'M' && strtoupper($_POST['txtGenero']) != 'H')
		{
			$mensaje = "Introduce un genero valido. (M=Mujer, H=Hombre)";
			$VALIDACION = false;
		}			
		
		$fecha = explode("/", $_POST['txtFechaNacimiento']);
		
		if(count($fecha) < 2 || !checkdate($fecha[1], $fecha[0], $fecha[2]))
		{
			$mensaje = "Fecha incorrecta, por favor validar.";
			$VALIDACION = false;
		}

		//AQUI VALIDAR SI EXISTE EL PAIS Y SI EXISTE LA CIUDAD
		$filtro['pais'] = new MongoRegex("/" . $_POST['txtPais'] . "/i");
		$datos = $PAIS->lista($filtro);
		$datos = iterator_to_array($datos);
		
		
		if(count($datos) == 0)
		{
			$mensaje = "Al parecer escribiste mal el nombre del pais. Por favor validalo.";
			$VALIDACION = false;			
		}else{
			if(count($datos) == 1)
			{
				$datos_tmp = array_keys($datos);
				
				$_POST['txtPais'] = $datos[$datos_tmp[0]]['pais'];
			}else{
				$mensaje = "Existe mas de un pais que coincide con el nombre que escribiste. Elige uno: <br/>";
				foreach($datos as $d)
				{
					$mensaje .= '<a href="#">' . $d['pais'] . "</a><br/>";
				}
				$VALIDACION = false;
			}
		}
		
		$filtro['ciudad'] = new MongoRegex("/" . $_POST['txtCiudad'] . "/i");
		$datos = $CIUDAD->lista($filtro);
		
		
		if($VALIDACION)
		{
			$DATOS = array();
			$DATOS['nombre']=$_POST['txtNombre'];
			$DATOS['apellidos']=$_POST['txtApellidos'];
			$DATOS['email']=$_POST['txtEmail'];
			$DATOS['password']=$_POST['txtPassword'];
			$DATOS['fechaNacimiento']=$_POST['txtFechaNacimiento'];
			$DATOS['pais']=$_POST['txtPais'];
			$DATOS['ciudad']=array('nombre' => $_POST['txtCiudad'],
								   'id' => ''
								);
			$DATOS['genero']=$_POST['txtGenero'];	

			$USUARIO->agregar($DATOS);
			
			$USUARIO->email = $_POST['txtEmail'];
			$USUARIO->password = $_POST['txtPassword'];
			$USUARIO->CONFIG = $CONFIG;
			$USUARIO->login();
			header("Location: authorize?client_id={$_GET['client_id']}&scope={$_GET['scope']}&status={$_GET['status']}&response_type={$_GET['response_type']}");
		}
		

	}				

//}catch(Exception $e){
//	$LOG->registra("Login", $e->getMessage(), "Ocurrio un error al intentar firmarse con el usuario " );
//}



?>
﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es"><head>


	<title>Identificarse en Inova 360</title>


		<?php include('bloques/estilos-oauth.php'); ?>
		<?php include('bloques/javascript-oauth.php'); ?>
<style>




#inputs input
{
    /*background: #f1f1f1 url(media/imagenes/login-sprite.png) no-repeat;*/
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
    <h1>Registrate <img src="media/imagenes/logo.gif" height="40" width="115"></h1>
<?php if($mensaje != ""){ ?>
<div style="padding: 20px; width: 360px;;" class="warning">
<?php echo $mensaje ?>
</div>
<?php } ?>
    <fieldset id="inputs">
		<span style="font-weight: bold;">Sobre ti</span><br/><br/>	
        <input id="txtNombre" name="txtNombre" type="text" placeholder="Nombre" autofocus required value="<?php echo (isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "") ?>">
        <input id="txtApellidos" name="txtApellidos" type="text" placeholder="Apellidos" required value="<?php echo (isset($_POST['txtApellidos']) ? $_POST['txtApellidos'] : "") ?>"><br/>
		<span>Fecha de Nacimiento</span><br/><br/>
		<input id="txtFechaNacimiento" name="txtFechaNacimiento" type="date" placeholder="Fecha de Nacimiento DD/MM/AAAA" required value="<?php echo (isset($_POST['txtFechaNacimiento']) ? $_POST['txtFechaNacimiento'] : "") ?>"><br/>
		<input id="txtGenero" name="txtGenero" type="text" placeholder="Genero H=Hombre, M=Mujer" required value="<?php echo (isset($_POST['txtGenero']) ? $_POST['txtGenero'] : "") ?>"><br/>
		<span style="font-weight: bold;">Ubicacion</span><br/><br/>	
		<input id="txtPais" name="txtPais" type="text" placeholder="Pais" required value="<?php echo (isset($_POST['txtPais']) ? $_POST['txtPais'] : "") ?>"><br/>
		<input id="txtCiudad" name="txtCiudad" type="text" placeholder="Ciudad" required value="<?php echo (isset($_POST['txtCiudad']) ? $_POST['txtCiudad'] : "") ?>"><br/>
		<span style="font-weight: bold;">Cuenta</span><br/><br/>	
		<input id="txtEmail" name="txtEmail" type="email" placeholder="Email" required value="<?php echo (isset($_POST['txtEmail']) ? $_POST['txtEmail'] : "") ?>"><br/>
		<input id="txtPassword" name="txtPassword" type="password" placeholder="Contraseña" required value="<?php echo (isset($_POST['txtPassword']) ? $_POST['txtPassword'] : "") ?>"><br/>		
		<input id="chkCondiciones" name="chkCondiciones" value="1" type="checkbox" style="width: auto;"> <label for = "recordar">
		Aceptas las <a href="#">Condiciones de uso</a> y la <a href="#">Política de privacidad</a> de Inova360 y que Inova360 te envíe comunicaciones, incluso por vía electrónica.
		</label>
		</fieldset>
		<fieldset id="actions">
			<input type="submit" id="submit" class="submit" value="Registrar datos">
			<a href="login?client_id=<?php echo $_GET['client_id']; ?>&scope=<?php echo $_GET['scope']; ?>&status=<?php echo $_GET['status']; ?>&response_type=<?php echo $_GET['response_type']; ?>">&iquest;Ya tienes una cuenta?</a><br/>
			<a href="login?client_id=<?php echo $_GET['client_id']; ?>&scope=<?php echo $_GET['scope']; ?>&status=<?php echo $_GET['status']; ?>&response_type=<?php echo $_GET['response_type']; ?>" class="negritas">Entra con tus datos de acceso</a>
		</fieldset>
</form>


</div>




</body>
</html>
