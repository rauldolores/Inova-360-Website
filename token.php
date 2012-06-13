<?php

include_once "clases/Inova360API.inc.php";

$oauth = new Inova360API();
$oauth->grantAccessToken();

?>

