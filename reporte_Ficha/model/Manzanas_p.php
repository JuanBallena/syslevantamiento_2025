<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Manzanas_p
{
	private $pdo;
    
    public $IdMz;
    public $Id_Mzna;
    public $IdSector;
    public $Cod_Mzna;
    public $Sys_Mzna;
    public $Nro_Mzna;
    
	public function ObtenerDatosConstrucciones($id)
	{
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();
		$Consulta="SELECT c_id_mzna,c_id_sector, c_codi_mzna,c_nume_mzna ".				 			  
				  "FROM tf_manzanas m ".
				  "inner join tf_ficha f on c.c_id_construccion = f.c_id_construccion ".				  
				  "WHERE c.c_id_uni_cat = '$id' ";
		$consulta_manzana= $BD->Consultas($Consulta);
		$manzanas=pg_fetch_all($consulta_manzana);
			if(!empty($manzanas))
				return $manzanas;
			else
				echo "";	
	}

}