<?php

include_once("../../librerias/php/JavaScriptPacker.class.php");
include_once("../../config.php");

$listaCSS = array('api/auth/estilos/formularios.css.php',
				  'api/auth/estilos/menu.css.php', 
				  'api/auth/estilos/ventanas.css.php' );
$listaJS = array('api/auth/javascript/menu.js.php',
				 'api/auth/javascript/ventana.js.php', 
				 'api/auth/javascript/general.js.php');
$listaHTML = array('api/auth/ventana.php', 
				   'api/auth/menu.php');

$contenidoCSS=cargaArchivos($listaCSS);
$contenidoHTML=cargaArchivos($listaHTML);
$contenidoJS=cargaArchivos($listaJS);

$contenido = "$('document').ready(function(){ ";
$contenido .= "$('head').prepend('" . '<style type="text/css">' . str_replace("'", "\'", limpiarCSS($contenidoCSS)) . "</style>');";
$contenido .= "$('body').prepend('" . limpiarHTML($contenidoHTML) . "');";
$contenido .= "});";
$contenido .= $contenidoJS;

$empaquetado = new JavaScriptPacker($contenido, 62, true, false);
$contenido = $empaquetado->pack();


file_put_contents("libreria-es.js", $contenido);

function cargaArchivos($archivos)
{
	global $CONFIG;
	$resultado = "";
	foreach($archivos as $archivo)
	{
		$codigo = file_get_contents($CONFIG["DOMINIO"] . $archivo);
		$resultado .= "$codigo";
	}
	
	return $resultado;
}

function limpiarHTML($html)
{
	preg_match_all('!(<(?:code|pre).*>[^<]+</(?:code|pre)>)!',$html,$pre);#exclude pre or code tags
 
	$html = preg_replace('!<(?:code|pre).*>[^<]+</(?:code|pre)>!', '#pre#', $html);#removing all pre or code tags
	$html = preg_replace('#<!–[^\[].+–>#', '', $html);#removing HTML comments
	$html = preg_replace('/[\r\n\t]+/', ' ', $html);#remove new lines, spaces, tabs
	$html = preg_replace('/>[\s]+</', '><', $html);#remove new lines, spaces, tabs
	$html = preg_replace('/[\s]+/', ' ', $html);#remove new lines, spaces, tabs
 
	if(!empty($pre[0]))
		foreach($pre[0] as $tag)
			$html = preg_replace('!#pre#!', $tag, $html,1);#putting back pre|code tags
 
	return $html;
}

function limpiarCSS($css)
{
	$css = preg_replace('!//[^\n\r]+!','', $css);#comments
	$css = preg_replace('/[\r\n\t\s]+/s', ' ', $css);#new lines, multiple spaces/tabs/newlines
	$css = preg_replace('#/\*.*?\*/#', '', $css);#comments
	$css = preg_replace('/[\s]*([\{\},;:])[\s]*/', '\1', $css);#spaces before and after marks
	$css = preg_replace('/^\s+/','', $css);#spaces on the begining
 
	return $css;
}


?>
