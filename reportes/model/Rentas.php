<?php
class Rentas
{
	private $pdo;

    public $CodCata;
    public $CodContribuyente;
    public $CodPredial;
    public $IdFicha;
    public $AcuCodPredial;

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

			$stm = $this->pdo->prepare("SELECT * FROM Rentas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerRenta($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Rentas WHERE IdFicha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}