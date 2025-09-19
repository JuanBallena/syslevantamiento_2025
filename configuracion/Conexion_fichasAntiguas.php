<?php
class Database
{
    public static function StartUp()
    {
    	//use any of these or check exact MSSQL ODBC drivername in "ODBC Data Source Administrator"
		//$mssqldriver = '{SQL Server}'; 
		//$mssqldriver = '{SQL Server Native Client 11.0}';
		//$mssqldriver = '{ODBC Driver 11 for SQL Server}';

		$hostname='LAPTOP-FPIDUEH3\SQLEXPRESS';
		$dbname='fichaAntiguas';
		$username='LAPTOP-FPIDUEH3\LORENA';
		$password='';

		//$pdo = new PDO("odbc:Driver=$mssqldriver;Server=$hostname;Database=$dbname", $username, $password);
        $pdo = new PDO('sqlsrv:Server='.$hostname.';Database='. $dbname,$username,$password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}

class SIMTRUX_Catastro
{
	private $pdo;

    public $codcata;
    
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

	public function ObtenerCodigoUso($id)
	{
		try 
		{	
			$stm = $this->pdo
			          ->prepare("SELECT Id_Lote as codcata, Cod_Uso,Desc_Uso FROM lotes 
					  			 INNER JOIN Ficha f on f.IdLote = l.IdLote
								 INNER JOIN Fichas_Individuales fi on fi.Id_Ficha = f.Id_Ficha
								 INNER JOIN Usos u on u.IdUso = fi.IdUso
								 WHERE Id_Lote = ?");
			          
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}