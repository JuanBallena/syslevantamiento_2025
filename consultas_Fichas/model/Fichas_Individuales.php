<?php
class Fichas_Individuales
{
	private $pdo;

    public $Id_Ficha;
    public $Contenido_En;
    public $Clasificacion;
    public $Area_Titulo;
    public $Area_Declarada;
    public $Area_Verificada;
    public $Porc_BC_Terr_Legal;
    public $Porc_BC_Terr_Const;
    public $Porc_BC_Fisc_Legal;
    public $Porc_BC_Fisc_Const;
    public $Evaluacion;
    public $En_Colindante;
    public $En_Jardin_Aislamiento;
    public $En_Area_Publica;
    public $En_Area_Intangible;
    public $Condicion_Declara;
    public $Estado_Llenado;
    public $Nro_Habitantes;
    public $Nro_Familias;
    public $Mantenimiento;
    public $Observaciones;
    public $IdUso;
    public $EstadoReg;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = BaseDatos::StartUp();     
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

			$stm = $this->pdo->prepare("SELECT * FROM Fichas_Individuales");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerFichaIndividual($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Fichas_Individuales WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}