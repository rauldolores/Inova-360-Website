<?php

/**
 * @file
 * Sample token endpoint.
 *
 * Obviously not production-ready code, just simple and to the point.
 *
 * In reality, you'd probably use a nifty framework to handle most of the crud for you.
 */

include_once "../../clases/Inova360OAuth2.inc.php";

$oauth = new Inova360OAuth2();
$oauth->grantAccessToken();

?>

