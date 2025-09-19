<?php
class Titulares
{
	private $pdo;

    public $IdTitulares;
    public $Id_Ficha;
    public $IdPersona;
    public $Forma_Adquisicion;
    public $Fecha_Adquisicion;
    public $Porcentaje_Cotitular;
    public $Estado_Civil;
    public $Fax;
    public $Telefono;
    public $Anexo;
    public $Correo_Elect;
    public $Nro_Titular;
    public $Cod_Contribuyente;
    public $IdDirecciones;
    public $Condic_Titular;

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

			$stm = $this->pdo->prepare("SELECT * FROM Titulares");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTitulares($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Titulares WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}