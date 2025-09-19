<?php
class Recap_Edificio
{
	private $pdo;

    public $IdRE;
    public $Id_ficha;
    public $Edificio;
    public $Total_Porc;
    public $Total_Atc;
    public $Total_Acc;
    public $Total_Aoic;

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

			$stm = $this->pdo->prepare("SELECT * FROM Recap_Edificio");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/** Obtenemos el Lote por Código Catastral */
	public function ObtenerRecapEdificio($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Recap_Edificio WHERE Id_ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}