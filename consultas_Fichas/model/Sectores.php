<?php
class Sectores
{
	private $pdo;
    
    public $IdSector;
    public $Id_Sector;
    public $IdUbigeo;
    public $Cod_Sector;
    public $Sys_Sector;
    
	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM Sectores");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerSector($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Sectores WHERE Cod_Sector = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

if(isset($_POST["SECTOR"])):

	require_once 'database.php';
	#require_once 'model/Lotes.php';
    #require_once 'model/Fichas.php';

	$oSector = new Sectores();
	$respuesta = $oSector->ObtenerSector($_POST["SECTOR"]);

	if(!empty($respuesta)){
		echo "Registrado";
	}
	else{
		echo "No Registrado";
	}
endif;