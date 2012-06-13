<?php
//validamos el scope
include_once "../../clases/Inova360OAuth2.inc.php";

$oauth = new Inova360OAuth2();

if ($_POST) {
  $oauth->finishClientAuthorization($_POST["accept"] == "Yep", $_POST);
}
$_GET['client_id'] = new MongoId($_GET['client_id']);
$auth_params = $oauth->getAuthorizeParams();
?>
