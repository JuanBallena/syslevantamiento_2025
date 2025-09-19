<?php
class Linderos
{
	private $pdo;

    public $Id_Ficha;
    public $Frente_Campo;
    public $Frente_Titulo;
    public $Frente_Colinda_Campo;
    public $Frente_Colinda_Titulo;
    public $Der_Campo;
    public $Der_Titulo;
    public $Der_Colinda_Campo;
    public $Der_Colinda_Titulo;
    public $Izq_Campo;
    public $Izq_Titulo;
    public $Izq_Colinda_Campo;
    public $Izq_Colinda_Titulo;
    public $Fondo_Campo;
    public $Fondo_Titulo;
    public $Fondo_Colinda_Campo;
    public $Fondo_Colinda_Titulo;

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

			$stm = $this->pdo->prepare("SELECT * FROM Linderos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLinderos($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Linderos WHERE Id_Ficha = ?");
			         
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}