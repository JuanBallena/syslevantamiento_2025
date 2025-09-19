<?php
class Multitabla
{
	private $pdo;

    public $IdMultitabla;
    public $Codigo;
    public $DescCodigo;
    public $IdTabla;
    public $Descripcion;

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
}