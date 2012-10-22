<?php
	include("../../../config.php");
?>
        $('document').ready(function(){
			
			$('.lightboxCLIQOO').live('click', function(){
				$('.backdrop').animate({'opacity':'.30'}, 300, 'linear');				
				$('.box').css({'left':($(document).width() / 2) - ($('.box').width() / 2) , 'opacity':'0.0' });
				$('.box').animate({'opacity':'0.90'}, 300, 'linear');				
				$('.backdrop, .box').css('display', 'block');
			});
				
			$('.close').live("click", function(){
				close_box();
			});
				
			$('.backdrop').click(function(){
				close_box();
			});			
			
        });
		
		$('#btnEntrarCLIQOO').live("click", function(){
			login();
		});
		
		
		$('#linkRecuperaPasswordCLIQOO').live("click", function(){
			muestraVentana(350, 200, '<?php echo $CONFIG["DOMINIO"]; ?>api/auth/ajax/callback.php?callback=?&accion=recuperaPasswordForm');
		});		
		
		$(window).scroll(function () {
			$('.backdrop, .box').css('top', 'none');
		});
		
		function close_box()
		{
			$('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear', function(){
				$('.backdrop, .box').css('display', 'none');
			});
		}		
		
		function muestraLogin()
		{
			muestraVentana(600, 300, '<?php echo $CONFIG["DOMINIO"]; ?>api/auth/ajax/callback.php?callback=?&accion=loginForm');
		}

		$('#btnAceptarCLIQOO').live("click", function(){
			muestraLogin();
		});		

		function muestraVentana(width, height, url)
		{
		
			$('#box').html('<p style="color: #fff; font-size: 18px; text-align: center;">Espera un segundo...</p>');
			$('.box').animate({'opacity':'0.90', 'width': width, 'height': height, 'left': ($(document).width() / 2) - (width / 2)}, 100, 'linear' , function (){ 
				$.getJSON(url, function(data){ 
					$('#box').html(data);
					$('[placeholder]').delay(800).blur();
				});
			});			
		}
		
