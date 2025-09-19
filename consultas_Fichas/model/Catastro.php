<?php
class Catastro
{
	private $pdo;
    
    public $codurba;
    public $codcalle;
    public $codcalle1;
    public $codcalle2;

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

			$stm = $this->pdo->prepare("SELECT * FROM catastro");
			$stm->execute();

			return $stm->fetchAll();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerCatastro($id)
	{
		$id = $id.'%';
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM catastro WHERE cod_cata = ? and denomina = '' and independiz = ''");			          

			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerCatastroxId($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM catastro WHERE cod_cata = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}