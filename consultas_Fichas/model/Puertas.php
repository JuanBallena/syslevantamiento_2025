<?php
class Puertas
{
	private $pdo;

    public $IdPuerta;
    public $Id_Puerta;
    public $IdLote;
    public $Cod_Puerta;
    public $Tip_Puerta;
    public $Nro_Muni;
    public $Condicion_Nro;
    public $IdVia;
    public $Nro_Certificacion;
    public $Orden;

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

			$stm = $this->pdo->prepare("SELECT * FROM Puertas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPuerta($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Puertas WHERE IdPuerta = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function ObtenerVia($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Puertas WHERE c_cod_via = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}