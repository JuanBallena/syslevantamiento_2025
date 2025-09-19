<?php
class Manzanas
{
	private $pdo;
    
    public $IdMz;
    public $Id_Mzna;
    public $IdSector;
    public $Cod_Mzna;
    public $Sys_Mzna;
    public $Nro_Mzna;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Manzanas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerManzana($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Manzanas WHERE IdMz = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}