<?php
class Habilitacion_Urbana
{
	private $pdo;
    
    public $IdHU;
    public $Id_Hab_Urba;
    public $Grupo_Urba;
    public $Nom_Hab_Urba;
    public $Tip_Hab_Urba;
    public $Cod_Hab_Urba;
    public $IdUbigeo;

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

			$stm = $this->pdo->prepare("SELECT * FROM Hab_Urba");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerHU($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Hab_Urba WHERE IdHU = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}