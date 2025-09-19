<?php

class TipoVia
{
	private $pdo;
	public $CODIGO;
	public $nombre;

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

			$stm = $this->pdo->prepare("SELECT * FROM Multitabla WHERE tipo = '04'");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTipoVia($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM MULTITABLA WHERE tipo = '04' and codigo = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTipoViaFiltrada($textFilter)
	{
	
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM  MULTITABLA WHERE tipo = '04' and descripcion like ? ");
			          
			$stm->execute(array("%$textFilter%"));			
			
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
}
?>