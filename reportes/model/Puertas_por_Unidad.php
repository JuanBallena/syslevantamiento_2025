<?php
class Puertas_por_Unidad
{
	private $pdo;

    public $IdPuerta;
    public $IdUniCat;

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

			$stm = $this->pdo->prepare("SELECT * FROM Puertas_por_Unidad");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPuertasPorUnidad($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Puertas_por_Unidad WHERE IdUniCat = ?");
			          
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}