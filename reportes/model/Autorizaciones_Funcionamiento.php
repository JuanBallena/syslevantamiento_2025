<?php
class Autorizaciones_Funcionamiento
{
	private $pdo;

    public $Id_Ficha;
    public $IdActividad;

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

			$stm = $this->pdo->prepare("SELECT * FROM Autorizaciones_Funcionamiento");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerAutorizacionesFuncionamiento($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Autorizaciones_Funcionamiento WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}