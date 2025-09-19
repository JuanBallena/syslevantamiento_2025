<?php
class Vias
{
	private $pdo;

    public $IdVia;
    public $Id_Via;
    public $Nom_Via;
    public $Tip_Via;
    public $Cod_Via;
    public $IdUbigeo;
    public $Id_Sys_Via;

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

			$stm = $this->pdo->prepare("SELECT * FROM Vias");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerVia($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Vias WHERE IdVia = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}