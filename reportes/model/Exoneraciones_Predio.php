<?php
class Exoneraciones_Predio
{
	private $pdo;

    public $IdExoneracionP;
    public $Id_Ficha;
    public $Condicion;
    public $Nro_Resolucion;
    public $Porcentaje;
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

			$stm = $this->pdo->prepare("SELECT * FROM Exoneraciones_Predio");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerExoneracionPredio($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Exoneraciones_Predio WHERE Id_Ficha = ?");
			         
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}