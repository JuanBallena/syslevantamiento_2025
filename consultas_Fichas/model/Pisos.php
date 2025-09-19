<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';

class Pisos
{
	private $BD;
	public $IdTipoMaterial;
	public $DesTipoMaterial;


	public function ListarNroPiso()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();	
			$consulta ="SELECT * FROM tf_pisos";
			$consulta_nroPisos= $BD->Consultas($consulta);
			$nroPisos=pg_fetch_all($consulta_nroPisos);
			if(!empty($nroPisos))
				return $nroPisos;
			else
				echo "";
	
	}

}
?>