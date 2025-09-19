<?php
class Edificaciones
{
	private $pdo;

    public $IdEdificacion;
    public $Id_Edificacion;
    public $IdLote;
    public $Cod_Edificacion;
    public $Tip_Edificacion;
    public $Nom_Edificacion;
    public $Clasificacion;
    public $Grupo_Edifica;

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

			$stm = $this->pdo->prepare("SELECT * FROM Edificaciones");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerEdificaciones($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Edificaciones WHERE IdLote = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerEdificacion($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Edificaciones WHERE IdEdificacion = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}