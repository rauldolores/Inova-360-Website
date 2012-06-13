<?php

include_once("../../librerias/JavaScriptPacker.class.php");
include_once("../../config.php");

$listaCSS = array('media/css/estilo-oauth.css');

$contenidoCSS=cargaArchivos($listaCSS);
	
$contenido = limpiarCSS($contenidoCSS);

file_put_contents("estilo.min.css", $contenido);

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
