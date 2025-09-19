<?php
class Multitablas
{
	private $pdo;

    public $Tipo;
    public $Desc;
    public $Codigo;
    public $Tabla;

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

			$stm = $this->pdo->prepare("SELECT * FROM Multitabla");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerMultitabla($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Multitabla WHERE Codigo = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTipoVia($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT TIPO, DESCRIPCION, CODIGO, TABLA FROM Multitabla where tipo = '04' and codigo = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>