<?php
	class BaseDatos
	{	
		private $pdo;
	    public static function StartUp()
	    {
			$hostname="LAPTOP-FPIDUEH3\SQLEXPRESS";
			$dbname="fichaAntiguas";
			$username=NULL;
			$password=NULL;

			try {
	        	$pdo = new PDO('sqlsrv:Server='.$hostname.';Database='. $dbname,$username,$password);		
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
				return $pdo;
			} catch(PDOException $ex) {
				echo 'Error conectando a la BBDD. '.$ex->getMessage(); 
		  	}
	    }
	}
?>