<?php
class Conductores
{
	private $pdo;

    public $IdConductor;
    public $Id_Ficha;
    public $IdPersona;
    public $Fax;
    public $Telefono;
    public $Anexo;
    public $Correo_Elect;
    public $Condicion_Conductor;

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

			$stm = $this->pdo->prepare("SELECT * FROM Conductores");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerConductor($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Conductores WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}