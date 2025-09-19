<?php
class Habilitacion_Urbana
{
	private $pdo;
    
    public $codurba;
    public $nombre;
    public $ActivUrba;
	public $Tipourbani;

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

			$stm = $this->pdo->prepare("SELECT * FROM Urbanizacion");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUrbanizacion($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT codurba,nombre,ActivUrba,tipourbani  FROM Urbanizacion WHERE codurba = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUrbanizacionActualizado($id)
	{
		$codurba = substr($id,6,5);
		
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT codurba,nombre,ActivUrba,tipourbani  FROM Urbanizacion WHERE codurba = ?");
			          
			$stm->execute(array($codurba));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
}