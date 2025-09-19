<?php
	class Database
	{
	    public static function StartUp()
	    {
			$hostname='SERVERPLAN3\PLANDET2008';
			$dbname='CATASTRO';
			$username='carlosul';
			$password='urteaga87';

	        $pdo = new PDO('sqlsrv:Server='.$hostname.';Database='. $dbname,$username,$password);

	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	        return $pdo;
	    }
	}
?>