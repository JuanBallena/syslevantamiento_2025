<?php
class Sunarp
{
	private $pdo;

    public $Id_Ficha;
    public $Tipo_Partida;
    public $Nro_Partida;
    public $Fojas;
    public $Asiento;
    public $Fecha_Inscripcion;
    public $Cod_Decla_Fabrica;
    public $Asiento_Fabrica;
    public $Fecha_Fabrica;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Sunarp");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerSunarp($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Sunarp WHERE Id_Ficha = ?");
			         
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}