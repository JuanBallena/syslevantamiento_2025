<?php
class Sys_Direcciones
{
	private $pdo;

    public $IdDirecciones;
    public $Sys_Dir;
    public $Referencia;
    public $Nro_Interior;
    public $Nro_Muni;
    public $IdVia;
    public $Sub_Lote_Muni;
    public $Lote_Muni;
    public $Mzna_Muni;
    public $IdHU;
    public $IdUbigeo;

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

			$stm = $this->pdo->prepare("SELECT * FROM Sys_Direcciones");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerSysDireccion($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Sys_Direcciones WHERE IdDirecciones = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}