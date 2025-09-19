<?php
class TecnicoC
{
	private $pdo;

    public $IdTecnico;
    public $Dni;
    public $Nombres;
    public $APaterno;
    public $AMaterno;
    public $Estado;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM TecnicoC");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTecnicoC($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM TecnicoC WHERE IdTecnico = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}