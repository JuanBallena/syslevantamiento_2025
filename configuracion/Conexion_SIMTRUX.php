<?php
class Database
{
    public static function StartUp()
    {

		$hostname='LAPTOP-FPIDUEH3\SQLEXPRESS';
		$dbname='simtrux';
		$username=NULL;
		$password=NULL;

	    $pdo = new PDO('sqlsrv:Server='.$hostname.';Database='. $dbname,$username,$password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}

class SIMTRUX_Catastro
{
	private $pdo;

    public $codcata;
    public $cod_cata;
    
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

	public function ObtenerCodigoReferenciaCatastral($id)
	{
		try 
		{	
			$stm = $this->pdo
			          ->prepare("SELECT codcata,cod_cata FROM Catastro WHERE cod_cata = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerCatastro($id)
	{
		try 
		{	
			$stm = $this->pdo
			          ->prepare("SELECT codurba,codcalle,num1a,num1b,num1c,codcalle1,num2a,num2b,num2c,
					  			codcalle2,NUM3A,NUM3B,NUM3C FROM Catastro WHERE cod_cata = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	
}