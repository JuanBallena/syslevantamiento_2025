<?php
class Personas
{
	private $pdo;

    public $IdPersona;
    public $Id_Persona;
    public $Nro_Doc;
    public $Tip_Doc;
    public $Tip_Persona;
    public $Nombres;
    public $Ape_Materno;
    public $Ape_Paterno;
    public $Tip_Persona_Juridica;
    public $Estado_Civil;
    public $CasadoCon;

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

			$stm = $this->pdo->prepare("SELECT * FROM Personas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerPersona($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Personas WHERE IdPersona = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}