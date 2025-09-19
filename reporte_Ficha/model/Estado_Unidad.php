<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';

class Estado_Unidad
{
	public $IdEstadoUnidad;
	public $DesEstadoUnidad;

	public function ListarEstados()
	{
		   
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$consulta ="SELECT i_cod_est_unid, c_des_est_unid FROM tf_estado_unidad";
			$consulta_estado= $BD->Consultas($consulta);
			$estados=pg_fetch_all($consulta_estado);
			if(!empty($estados))
				return $estados;
			else
				echo '';
		
	}

	public function ObtenerEstadoUnidad($id)
	{
			
			$BD=new BaseDeDatos(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
			$BD->conectar();
			$Consulta="SELECT eu.i_cod_est_unid, eu.c_des_est_unid ".
					  "FROM tf_ficha f  ".
					  "INNER JOIN tf_estado_unidad eu ON f.i_cod_est_unid = eu.i_cod_est_unid ".
					  "WHERE c_id_uni_cat = '$id'";					  				
			$consulta_estado= $BD->Consultas($Consulta);
			$consulta_est = pg_fetch_array($consulta_estado);
			if(!empty($consulta_est))
				return $consulta_est;
			else
				echo '';			
	}
}
?>