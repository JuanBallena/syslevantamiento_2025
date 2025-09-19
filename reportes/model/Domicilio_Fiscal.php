<?php
class Domicilio_Fiscal
{
	private $pdo;

    public $IdDomicilioF;
    public $Id_Ficha;
    public $Departamento;
    public $Provincia;
    public $Nombre_Distrito;
    public $Cod_Via;
    public $Tip_Via;
    public $Nombre_Via;
    public $IdDirecciones;

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

			$stm = $this->pdo->prepare("SELECT * FROM Domicilio_Fiscal");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerDomicilioFiscal($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Domicilio_Fiscal WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}