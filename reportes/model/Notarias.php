<?php
class Notarias
{
	private $pdo;

    public $IdNotaria;
    public $Nom_Notaria;
    public $Id_Ubi_Geo;

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

			$stm = $this->pdo->prepare("SELECT * FROM Notarias");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/** Obtenemos el Lote por Código Catastral */
	public function ObtenerNotaria($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Notarias WHERE IdNotaria = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}