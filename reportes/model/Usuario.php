<?php
class Usuario
{
	private $pdo;

    public $IdUsuario;
    public $LoginU;
    public $PasswordU;
    public $X2;
    public $Estado;
    public $IdPersonal;
    
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

			$stm = $this->pdo->prepare("SELECT * FROM Usuario");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUsuario($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Usuario WHERE IdUsuario = ?");

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}