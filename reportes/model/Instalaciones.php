<?php
class Instalaciones
{
	private $pdo;

    public $IdInstalacion;
    public $Id_Ficha;
    public $IdCodInst;
    public $Mes;
    public $Anio;
    public $Mep;
    public $Ecs;
    public $Ecc;
    public $Dimension_Largo;
    public $Dimension_Ancho;
    public $Dimension_Alto;
    public $Producto_Total;
    public $Uca;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Instalaciones");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerInstalaciones($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Instalaciones WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}