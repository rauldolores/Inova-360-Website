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
		$this->MAIL->Host = "ssl://" . $this->SERVIDOR; // SMTP a utilizar. Por ej. smtp.elserver.com
		$this->MAIL->Username = $this->USUARIO; // Correo completo a utilizar
		$this->MAIL->Password = $this->PASSWORD; // Contrase�a
		$this->MAIL->Port = $this->PUERTO; // Puerto a utilizar
	}


	function EnviarCorreo($nombre, $desde, $para, $asunto, $mensaje)
	{
		$this->MAIL->SetFrom($desde, $nombre); // Desde donde enviamos (Para mostrar)
		$this->MAIL->Sender=$desde;
		//Estas dos l�neas, cumplir�an la funci�n de encabezado (En mail() usado de esta forma: �From: Nombre <correo@dominio.com>�) de //correo.
		$this->MAIL->AddAddress($para); // Esta es la direcci�n a donde enviamos
		$this->MAIL->IsHTML(true); // El correo se env�a como HTML
		$this->MAIL->Subject = $asunto; // Este es el titulo del email.
		$this->MAIL->MsgHTML($mensaje);
		$exito = $this->MAIL->Send(); // Env�a el correo.

		//Tambi�n podr�amos agregar simples verificaciones para saber si se envi�:
		if($exito){
			return true;
		}else{
			return false;
		}	
	}
}