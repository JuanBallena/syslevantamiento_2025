<?php
class Lotes
{
	private $pdo;
    
    public $IdLote;
    public $Id_Lote;
    public $IdMz;
    public $IdHU;
    public $Mzna_Dist;
    public $Lote_Dist;
    public $Sub_Lote_Dist;
    public $Estructuracion;
    public $Zonificacion;
    public $Sys_Lote;
    public $Cuc;
    public $Cod_Pred_Rentas;
    public $Cod_Acum_Rentas;

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

			$stm = $this->pdo->prepare("SELECT * FROM Lotes");
			$stm->execute();

			return $stm->fetchAll();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLotes($id)
	{
		$id = $id.'%';
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Lotes WHERE Id_Lote LIKE ?");			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerLote($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Lotes WHERE Id_Lote = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}