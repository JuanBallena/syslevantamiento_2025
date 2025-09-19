<?php
class Usos
{
	private $pdo;

    public $IdUso;
    public $Cod_Uso;
    public $Desc_Uso;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = BaseDatos::StartUp();     
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

			$stm = $this->pdo->prepare("SELECT * FROM Usos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUso($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Usos WHERE IdUso = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerCodigoUso($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Usos WHERE Cod_Uso = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}