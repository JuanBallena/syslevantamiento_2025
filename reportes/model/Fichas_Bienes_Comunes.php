<?php
class Fichas_Bienes_Comunes
{
	private $pdo;

    public $Id_Ficha;
    public $Clasificacion;
    public $Contenido_En;
    public $Area_Titulo;
    public $Area_Declarada;
    public $Area_Verificada;
    public $En_Colindante;
    public $En_Jardin_Aislamiento;
    public $En_Area_Publica;
    public $En_Area_Intangible;
    public $Condicion_Declara;
    public $Estado_Llenado;
    public $Mantenimiento;
    public $Observaciones;
    public $IdUso;
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

			$stm = $this->pdo->prepare("SELECT * FROM Fichas_Bienes_Comunes");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerFichaBienComun($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Fichas_Bienes_Comunes WHERE Id_Ficha = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}