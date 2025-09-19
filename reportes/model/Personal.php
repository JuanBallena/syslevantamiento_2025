<?php
class Personal
{
	private $pdo;

    public $IdPersonal;
    public $Nombres;
    public $APaterno;
    public $AMaterno;
    public $Dni;
    public $Cargo;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Personal");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPersonal($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Personal WHERE IdPersonal = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}