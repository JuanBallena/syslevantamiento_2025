<?php
class Autorizaciones_Anuncios
{
	private $pdo;
 
    public $IdAnuncio;
    public $Id_Ficha;
    public $Cod_Anuncio;
    public $Nro_Lados;
    public $Area_Autorizada;
    public $Area_Verificada;
    public $Nro_Expediente;
    public $Nro_Licencia;
    public $Fecha_Expedicion;
    public $Fecha_Vencimiento;

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

			$stm = $this->pdo->prepare("SELECT * FROM Autorizaciones_Anuncios");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerAutorizacionesAnuncios($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Autorizaciones_Anuncios WHERE Id_Ficha = ?");
			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}