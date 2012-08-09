<?php

class Mail
{

	public $CONEXION;
	public $LOG;
	public $CONFIG;
	public $SERVIDOR;
	public $PUERTO;
	public $USUARIO;
	public $PASSWORD;
	public $MAIL;
	
	function __construct($config) {
		$this->LOG = new Log();
		$this->SERVIDOR = $config['SMTP_SERVIDOR'];
		$this->PUERTO = $config['SMTP_PUERTO'];
		$this->USUARIO = $config['SMTP_USUARIO'];
		$this->PASSWORD = $config['SMTP_PASSWORD'];
		
		$this->MAIL = new PHPMailer();
		$this->MAIL->IsSMTP();
		$this->MAIL->SMTPAuth = true;
		$this->MAIL->Host = $this->SERVIDOR; // SMTP a utilizar. Por ej. smtp.elserver.com
		$this->MAIL->Username = $this->USUARIO; // Correo completo a utilizar
		$this->MAIL->Password = $this->PASSWORD; // Contraseña
		$this->MAIL->Port = $this->PUERTO; // Puerto a utilizar
	}



	function EnviarCorreo($nombre, $desde, $para, $asunto, $mensaje)
	{
		$this->MAIL->From = $desde; // Desde donde enviamos (Para mostrar)
		$this->MAIL->FromName = $nombre;

		//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
		$this->MAIL->AddAddress($para); // Esta es la dirección a donde enviamos
		$this->MAIL->IsHTML(true); // El correo se envía como HTML
		$this->MAIL->Subject = $asunto; // Este es el titulo del email.
		$this->MAIL->Body = $mensaje; // Mensaje a enviar
		$exito = $this->MAIL->Send(); // Envía el correo.

		//También podríamos agregar simples verificaciones para saber si se envió:
		if($exito){
			return true;
		}else{
			return false;
		}	
	}
}