<?php
class Exoneraciones_Titular
{
	private $pdo;

    public $IdExoneracionT;
    public $Id_Ficha;
    public $IdPersona;
    public $Condicion;
    public $Nro_Resolucion;
    public $Nro_Boleta_Pension;
    public $Fecha_Inicio;
    public $Fecha_Vencimiento;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Exoneraciones_Titular");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerExoneracionTitular($id,$per)
	{	
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Exoneraciones_Titular WHERE Id_Ficha = ? and IdPersona = ? ");
			         
			$stm->execute(array($id,$per));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}