<?php
class Servicios_Basicos
{
	private $pdo;

    public $Id_Ficha;
    public $Luz;
    public $Agua;
    public $Telefono;
    public $Desague;
    public $Nro_Sum_Luz;
    public $Nro_Contrato_Agua;
    public $Nro_Telefono;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Servicios_Basicos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/** Obtenemos el Lote por Código Catastral */
	public function ObtenerServiciosBasicos($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Servicios_Basicos WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}