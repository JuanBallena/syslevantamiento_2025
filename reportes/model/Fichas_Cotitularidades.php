<?php
class Fichas_Cotitularidades
{
	private $pdo;

    public $Id_Ficha;
    public $Total_Cotitulares;
    public $Condicion_Declarante;
    public $Estado_Llenado;
    public $Observaciones;
    public $EstadoReg;

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

			$stm = $this->pdo->prepare("SELECT * FROM Fichas_Cotitularidades");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerFichaCotitular($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Fichas_Cotitularidades WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}