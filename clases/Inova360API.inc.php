<?php

include ("librerias/php/oauth2/OAuth2.inc.php");

/**
 * Libreria Inova360 OAuth2 con implementacion Mongo DB.
 */
class Inova360API extends OAuth2 {

  private $db;

  /**
   * Overrides OAuth2::__construct().
   */
  public function __construct() {
    parent::__construct();

    $mongo = new Mongo();
    $this->db = $mongo->selectDB("innet");
  }

  /**
   * Little helper function to add a new client to the database.
   *
   * Do NOT use this in production! This sample code stores the secret
   * in plaintext!
   *
   * @param $client_id
   *   Client identifier to be stored.
   * @param $client_secret
   *   Client secret to be stored.
   * @param $redirect_uri
   *   Redirect URI to be stored.
   */
  /*public function addClient($client_id, $client_secret, $redirect_uri) {
    $this->db->clients->insert(array(
      "_id" => new MongoId($client_id),
      "pw" => $client_secret,
      "redirect_uri" => $redirect_uri
    ));
  }*/

  public function validarConsumidor($client_id, $user_id)
  {
    $client = $this->db->tokens->findOne(array("consumidorId" => new MongoId($client_id), "usuarioId" => new MongoId($user_id)));
    return $client !== NULL;
  }  

  public function obtenerToken($client_id, $user_id)
  {
    $client = $this->db->tokens->findOne(array("consumidorId" => new MongoId($client_id), "usuarioId" => new MongoId($user_id)));
    return $client;
  }  

  public function crearToken($client_id, $scope)
  {
    $client = $this->createAccessToken($client_id, $scope);
    return $client;
  }

  protected function checkClientCredentials($client_id, $client_secret = NULL) {
    $client = $this->db->consumidores->findOne(array("_id" => new MongoId($client_id), "llaveSecreta" => $client_secret));
    return $client !== NULL;
  }


  protected function getRedirectUri($client_id) {
    $uri = $this->db->consumidores->findOne(array("_id" => new MongoId($client_id)), array("urlRedireccionar"));
    return $uri !== NULL ? $uri["urlRedireccionar"] : FALSE;
  }


  protected function getAccessToken($oauth_token) {
    return $this->db->tokens->findOne(array("_id" => $oauth_token));
  }

  protected function setAccessToken($oauth_token, $client_id, $expires, $scope = NULL, $user_id) {
    //Eliminamos tokens expirados
    $this->db->tokens->remove(array(
      "consumidorId" => new MongoId($client_id),
      "usuarioId" => new MongoId($user_id)
    ));

    //Creamos nuevo token
    $this->db->tokens->insert(array(
      "_id" => $oauth_token,
      "consumidorId" => new MongoId($client_id),
      "usuarioId" => new MongoId($user_id),
      "expiracion" => $expires,
      "alcance" => $scope
    ));

  }

  protected function getSupportedGrantTypes() {
    return array(
      OAUTH2_GRANT_TYPE_AUTH_CODE,
    );
  }

  protected function getAuthCode($code) {
    $stored_code = $this->db->codigosAutorizacion->findOne(array("_id" => $code));
    return $stored_code !== NULL ? $stored_code : FALSE;
  }

  protected function setAuthCode($code, $client_id, $redirect_uri, $expires, $scope = NULL) {

    $client_id = new MongoId($client_id);

    $this->db->codigosAutorizacion->insert(array(
      "_id" => $code,
      "consumidorId" => $client_id,
      "urlRedireccionar" => $redirect_uri,
      "expiracion" => $expires,
      "alcance" => $scope
    ));
  }

	protected function getSupportedScopes() {
		return array(
			'all',
			'general_information',
			'contact_information',
			'education_information',
			'work_information',
			'location',
			'user_media',
			'stream',
			'events',
			'user_friends',
			'user_groups',
			'user_status',
			'mailbox',
			'notifications'
		);
	}

}
