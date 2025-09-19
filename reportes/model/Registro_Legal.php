<?php
class Registro_Legal
{
	private $pdo;

    public $Id_Ficha;
    public $IdNotaria;
    public $Kardex;
    public $Fecha_Escritura;

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

			$stm = $this->pdo->prepare("SELECT * FROM Registro_Legal");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerRegistroLegal($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Registro_Legal WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}