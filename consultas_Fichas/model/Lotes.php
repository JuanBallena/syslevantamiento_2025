<?php
class Lotes
{
	private $pdo;
    
    public $idlote;
    public $codlote;
    public $idmanzana;
    public $estado;

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

			$stm = $this->pdo->prepare("SELECT * FROM Lote");
			$stm->execute();

			return $stm->fetchAll();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLotes($id)
	{
		$id = $id.'%';
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT distinct * FROM Lote WHERE idlote LIKE ?");			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLote($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT distinct * FROM Lote WHERE idlote = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}