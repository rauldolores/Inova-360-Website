<?php
	include("../../../config.php");
?>
(function ($) {
  $.fn.fixedMenu = function () {
    return this.each(function () {
      var menu = $(this);
      menu.find('ul li > a').live('click', function () {
        //check whether the particular link has a dropdown
        if (!$(this).parent().hasClass('singleLinkCliqoo') && !$(this).parent().hasClass('current')) {
          //hiding drop down menu when it is clicked again
          if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
          }
          else {
            //displaying the drop down menu
            $(this).parent().parent().find('.active').removeClass('active');
            $(this).parent().addClass('active');
          }
        }
        else {
          //hiding the drop down menu when some other link is clicked
          $(this).parent().parent().find('.active').removeClass('active');

        }
      })
    });
  }
})(jQuery);


$('document').ready(function(){

	//Hechamos a andar el menu
	$('.menuCLIQOO').fixedMenu();

	//Parametros de INOVA360
	//ejemplo: client_id=4f90f4fc8a830862be34b86c&scope=all&status=1&response_type=code
	var QUERY = "";
	if(typeof( window[ 'INOVA360_CLIENTID' ] ) != "undefined")
		QUERY += 'client_id=' + INOVA360_CLIENTID + '&';

	if(typeof( window[ 'INOVA360_SCOPE' ] ) != "undefined")
		QUERY += 'scope=' + INOVA360_SCOPE + '&';

	QUERY += 'status=1&response_type=code&';

	//Cargamos los datos del menu
	$.getJSON('<?php echo $CONFIG["DOMINIO"]; ?>api/auth/ajax/menu.php?'+QUERY+'callback=?', function(data){ 
		$('.menuCLIQOO').html(data);   
	});	
	
});
