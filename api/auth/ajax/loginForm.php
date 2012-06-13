<?php
	include("../../../config.php");
?>

	<div style ="background-color: #000; height: 40px;">
		<div style="float:left; padding-top: 6px; color: #fff; font-size: 18px;">Entra a tu cuenta <span style="font-weight: bold;">Inova360</span></div>
		<div class="close" style="float:right;">x</div>
	</div>
	
	<div>
		<div style="padding: 10px;">
			<div style="float:left;"> 
				<label for="emailLoginCLIQOO">Email o telefono:</label><br>
				<input type="text" id="emailLoginCLIQOO" name="emailLoginCLIQOO" value="" style="width: 230px;"  /> <br>
 
				<label for="passwordLoginCLIQOO">Password:</label> <br>
				<input type="password" name="passwordLoginCLIQOO" id="passwordLoginCLIQOO" value="" style="width: 230px;"  /><br>
			
				<input id="memento" type="checkbox" checked="checked" name="memento"> Recordar mis datos para futuras ocasiones<br>
			
				<button class="action red" id="btnEntrarCLIQOO"><span class="label">Entrar</span></button> <a href="#" style="color: #4B8EFB;" id="linkRecuperaPasswordCLIQOO">&iquest;Olvidaste la contrase&ntilde;a?</a>
				<input type="hidden" id="urlRedirectCLIQOO" value="" />
			</div>
			<div style="float:left;height: 200px; width: 30px; "></div>
			<div style="float:left; background-color: #333; height: 200px; width: 1px; "></div>
			<div style="float:right; width: 260px;">
			Si aun no cuentas con una cuenta Inova360 puedes ingresar con tu cuenta: <br/>	<br/>
			<img src="<?php echo $CONFIG["DOMINIO"]; ?>api/auth/imagenes/twitter.png" border="0">
			<img src="<?php echo $CONFIG["DOMINIO"]; ?>api/auth/imagenes/facebook.png" border="0"><br/><br/>
			O si lo prefieres puedes obtener de manera gratuita tu cuenta Cliqoo registrandote aqui. Es rapido.<br/><br/>
			<a href="#" style="font-size: 20px; color: #4B8EFB;">Obten tu cuenta Inova360</a>
			</div>
		</div>
	</div>
