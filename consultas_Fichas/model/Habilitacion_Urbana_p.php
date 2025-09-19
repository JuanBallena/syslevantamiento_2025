<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Habilitacion_Urbana_p
{
	private $pdo;
    
    public $codurba;
    public $nombre;
    public $ActivUrba;
	public $Tipourbani;

	public function ListarGrupoHU()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$consulta ="SELECT c_cod_tip_zce, c_desc_tip_zce FROM tf_grupo_hu";
			$consulta_estado= $BD->Consultas($consulta);
			$estados=pg_fetch_all($consulta_estado);
			return $estados;
	}

	public function ObtenerGrupoHU($id)
	{
			$BD=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
			$BD->conectar();
			$Consulta="SELECT hu.c_cod_tip_zce, hu.c_desc_tip_zce ".
					  "FROM tf_ficha f  ".
					  "INNER JOIN tf_grupo_hu hu ON f.c_tipozce = hu.c_cod_tip_zce ".
					  "WHERE c_id_uni_cat = '$id'";					  				
			$consulta_estado= $BD->Consultas($Consulta);
			$consulta_est = pg_fetch_array($consulta_estado);
			if(!empty($consulta_est))
				return $consulta_est;
			else
				echo "";			
	}
}
?>