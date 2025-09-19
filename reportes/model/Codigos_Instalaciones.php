<?php
class Codigos_Instalaciones
{
	private $pdo;

    public $IdCodInst;
    public $Cod_Instalacion;
    public $Unidad;
    public $Material;
    public $Desc_Instalacion;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Codigos_Instalaciones");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerCodInstalacion($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Codigos_Instalaciones WHERE IdCodInst = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}