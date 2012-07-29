<?php

class Mail
{

	public $CONEXION;
	public $LOG;
	public $CONFIG;
	public $AWS_KEY;
	public $AWS_SECRET_KEY;
	public $AWS_SES_FROM_EMAIL;
	
	function __construct($config) {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
		$this->AWS_KEY = $config['AWS_KEY'];
		$this->AWS_SECRET_KEY = $config['AWS_SECRET_KEY'];
		$this->AWS_SES_FROM_EMAIL = $config['AWS_SES_FROM_EMAIL'];
	}



	function EnviarCorreo($para, $asunto, $mensaje)
	{
		$amazonSes = new AmazonSES($this->AWS_KEY, $this->AWS_SECRET_KEY);
	 
		$response = $amazonSes->send_email($this->AWS_SES_FROM_EMAIL,
			array('ToAddresses' => array($para)),
			array(
				'Subject.Data' => $asunto,
				'Body.Text.Data' => $mensaje,
			)
		);
		if (!$response->isOK())
		{
			// handle error
		}	
	}
}