<?php
class Litigantes
{
	private $pdo;

    public $IdLitigante;
    public $Id_Ficha;
    public $IdPersona;
    public $Cod_Contribuye;

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

			$stm = $this->pdo->prepare("SELECT * FROM Litigantes");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLitigantes($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Litigantes WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}