<?php
class Documentos_Adjuntos
{
	private $pdo;

    public $IdDocumento;
    public $Id_Ficha;
    public $Tip_Doc;
    public $Nro_Doc;
    public $Fecha_Doc;
    public $Area_Autorizada;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Documentos_Adjuntos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerDocumentosAdjuntos($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Documentos_Adjuntos WHERE Id_Ficha = ?");
			         
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}