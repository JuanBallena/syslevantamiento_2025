<?php
class Fichas_Economicas
{
	private $pdo;

    public $Id_Ficha;
    public $Nom_Comercial;
    public $Predio_Area_Autor;
    public $Predio_Area_Verif;
    public $Viap_Area_Autor;
    public $Viap_Area_Verif;
    public $BC_Area_Autor;
    public $BC_Area_Verif;
    public $Total_Area_Autor;
    public $Total_Area_Verif;
    public $Nro_Expediente;
    public $Nro_Licencia;
    public $Fecha_Expedicion;
    public $Fecha_Vencimiento;
    public $Inicio_Actividad;
    public $Condicion_Declarante;
    public $Estado_Llenado;
    public $Mantenimiento;
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

			$stm = $this->pdo->prepare("SELECT * FROM Fichas_Economicas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerFichaEconomica($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Fichas_Economicas WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}