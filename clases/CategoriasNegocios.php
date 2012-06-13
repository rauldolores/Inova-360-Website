<?php 
include_once("Log.php");

class CategoriasNegocios{
	
	public $CONEXION;
	public $LOG;
	public $CONFIG;
	
	function __construct() {
		$this->CONEXION = new Mongo();
		$this->LOG = new Log();
	}
	

	function agregar($padre, $categoria)
	{
		
		$DATOS['padre'] = utf8_encode($DATOS['padre']);
		$DATOS['categoria'] = utf8_encode($DATOS['categoria']);
		
		try
		{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->categoriasNegocios;

			if(!$this->existe($DATOS['codigo']))
			{
				$COLECCION->insert($DATOS);	
			}

		}
		catch(Exception $e)
		{
			$this->LOG->registra("Paises", $e->getMessage(), "No es posible agregar la categoria " . $categoria);
			return false;	
		}
		return true;
	}
	
	function existe($categoria)
	{
		$DATOS = array();		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->categoriasNegocios;			
			$DATOS["categoria"] = $categoria;
			$CATEGORIAS = $COLECCION->findOne($DATOS);
					
			if(count($CATEGORIAS) == 0)
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Categorias", $e->getMessage(), "No existe la categoria " . $categoria);
			return false;
		}
		
		return true;		
	}
	
	function eliminar($categoria)
	{
		$DATOS = array();
		try
		{
			$DATOS['categoria']=$categoria;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->categoriasNegocios;

			$COLECCION->remove($DATOS);
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Categorias", $e->getMessage(), "No es posible eliminar la categoria " . $categoria);
			return false;	
		}		
	}
	
	function editar($padre, $categoria)
	{
		$DATOS = array();
		
		$padre = utf8_encode($padre);
		$categoria = utf8_encode($categoria);
		
		try
		{
			$DATOS['padre']=$padre;
			$DATOS['categoria']=$categoria;

			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->categoriasNegocios;

			$COLECCION->update(array('categoria' => $categoria), array( '$set' => $DATOS));
			
		}
		catch(Exception $e)
		{
			$this->LOG->registra("Categorias", $e->getMessage(), "No es posible editar la categoria " . $categoria);
			return false;	
		}		
		return true;
		
	}
	
	function lista($DATOS)
	{
		$RESULTADO = array();
		
		try{
			$DB = $this->CONEXION->innet;
			$COLECCION = $DB->categoriasNegocios;

			$cursor = $COLECCION->find($DATOS);

			return $cursor;
		
		}catch(Exception $e){
			$this->LOG->registra("Categorias", $e->getMessage(), "No es posible listar las categorias");
			return false;
		}
		
		return true;
	}
	
	

}

?>
