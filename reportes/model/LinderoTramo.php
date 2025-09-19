<?php
class LinderoTramo
{
	private $pdo;

    public $IdLindero;
    public $Id_Ficha;
    public $LFrente;
    public $CFrente;
    public $TFrente;
    public $LDerecha;
    public $CDerecha;
    public $TDerecha;
    public $LIzquierda;
    public $CIzquierda;
    public $TIzquierda;
    public $LFondo;
    public $CFondo;
    public $TFondo;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM LinderoTramo");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLinderosTramos($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM LinderoTramo WHERE Id_Ficha = ?");
			         
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}