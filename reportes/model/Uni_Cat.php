<?php
class Uni_Cat
{
	private $pdo;

	public $IdUniCat;
	public $Id_Uni_Cat;
	public $IdLote;
	public $IdEdificacion;
	public $Cod_Entrada;
	public $Cod_Piso;
	public $Cod_Unidad;
	public $Tip_Interior;
	public $Nro_Interior;
	public $Cuc;
	public $Cuc_Antecedente;
	public $Codigo_Hoja_Cat;
	public $Cod_Pred_Rentas;
	public $Uni_Acum_Rentas;
	public $Descripcion_Unidades;

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

			$stm = $this->pdo->prepare("SELECT * FROM Uni_Cat");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUnidadesCatastrales($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Uni_Cat WHERE IdLote = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUnidadCatastral($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Uni_Cat WHERE IdUniCat = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}