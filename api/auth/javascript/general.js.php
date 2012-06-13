<?php
	include("../../../config.php");
?>


		function login()
		{

			if(validarFormulario())
			{
			
				$.getJSON("<?php echo $CONFIG["DOMINIO"]; ?>api/auth/ajax/login.php?callback=?", 
					{ AJAX: true,
						ACCION: "loginUsuario",
						email: $("#emailLoginCLIQOO").val(), 
						password: $("#passwordLoginCLIQOO").val()},
				   	 
						function(data) {
						if(data != "")
						{
							MostrarMensaje("Error", data, 300, 150);
						}else{
							//Sigue el procedimiento de pasar a el dashboard
							if( $("#urlRedirectCLIQOO").val() == "")
								location.reload(true);
							else
								window.location = $("#urlRedirectCLIQOO").val();
						}

					 });				
			}				
		}
		
		
		function logout()
		{
				$.getJSON("<?php echo $CONFIG["DOMINIO"]; ?>api/auth/ajax/logout.php?callback=?", 
					{ AJAX: true},
				   	 
						function(data) {
						if(data != "")
						{
							MostrarMensaje("Error", data, 300, 150);
						}else{	
								location.reload(true);
						}
					 });								
		}		
		
		function validarFormulario()
		{
			if(!validaEmail($("#emailLoginCLIQOO").val().trim()))
			{
				MostrarMensaje("Validaci&oacute;n", "Es necesario que introduzcas un <i>email</i> v&aacute;lido.", 300, 150);
				return false;
			}

			if($("#passwordLoginCLIQOO").val().trim() == "")
			{
				MostrarMensaje("Validaci&oacute;n", "Es necesario que introduzca un <i>Password</i>.", 300, 150);
				return false;
			}			

			return true;
		}
		
		function MostrarMensaje(titulo, mensaje, width, height)
		{
			
			$('.box').animate({'opacity':'0.90', 'width': width, 'height': height, 'left': ($(document).width() / 2) - (width / 2)}, 100, 'linear' , function (){ 
				$.getJSON('<?php echo $CONFIG["DOMINIO"]; ?>api/auth/ajax/callback.php?callback=?&accion=mensaje', function(data){ 
					$('#box').html(data);   
					$('#mensajeVentanaCLIQOO').html(mensaje);   
					$('#tituloVentanaCLIQOO').html(titulo);   
					
				});
			});		
		}
		

		function validaEmail(value) {
			return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value);	
		}	

		
