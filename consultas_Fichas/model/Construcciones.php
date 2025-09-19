<?php
class Construcciones
{
	private $pdo;

	public $IdConstruc;
	public $Id_Ficha;
	public $Nro_Piso;
	public $Mes;
	public $Anio;
	public $Mep;
	public $Ecs;
	public $Ecc;
	public $Estru_Muro_Col;
	public $Estru_Techo;
	public $Acaba_Piso;
    public $Acaba_Puerta_Ven;
    public $Acaba_Revest;
    public $Acaba_Bano;
    public $Inst_Elect_Sanita;
    public $Area_Declarada;
    public $Area_Verificada;
    public $Uca;

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

			$stm = $this->pdo->prepare("SELECT * FROM Construcciones");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerConstrucciones($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Construcciones WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}