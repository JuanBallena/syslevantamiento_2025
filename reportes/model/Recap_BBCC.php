<?php
class Recap_BBCC
{
	private $pdo;
    
    public $IdRBC;
    public $Id_Ficha;
    public $Edifica;
    public $Entrada;
    public $Piso;
    public $Unidad;
    public $Porc;
    public $ATC;
    public $ACC;
    public $AOIC;

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

			$stm = $this->pdo->prepare("SELECT * FROM Recap_BBCC");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/** Obtenemos el Lote por Código Catastral */
	public function ObtenerRecapBBCC($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Recap_BBCC WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}