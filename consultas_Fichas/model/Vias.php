<?php

class Vias
{
	private $pdo;

    public $codcalle;//codigo de via
    public $nombvia;//nombre
    public $estado;
    public $tvia_cal;//tipo de via
    public $codurba;

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

			$stm = $this->pdo->prepare("SELECT * FROM Via");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerVia($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT codcalle, nombvia, estado, tvia_cal, codurba FROM Via WHERE codcalle = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	

	function ObtenerViasFiltradas($textFilter)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT codcalle,nombvia FROM Via WHERE nombvia LIKE ? ");
			          
			$stm->execute(array("%$textFilter%"));
			
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
}
?>