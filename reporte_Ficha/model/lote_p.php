<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Lotes_p
{
	

    public $IdVia;
    public $Id_Via;
    public $Nom_Via;
    public $Tip_Via;
    public $Cod_Via;
    public $IdUbigeo;
    public $Id_Sys_Via;

	 //Verifica si tiene c_id_uni_cat en la tabla tf_ficha
	 public function ObtenerDatosLote($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_ViasPuertas = $BD->Consultas("SELECT distinct c_id_sector,f.c_id_uni_cat,u.c_id_lote, l.c_id_hab_urba, c_mzna_dist, c_lote_dist, c_sub_lote_dist ".										  	   									
		  								  "FROM tf_ficha f ".
										  "inner join tf_uni_cat u on f.c_id_uni_cat = u.c_id_uni_cat ".
										  "inner join tf_lotes l on l.c_id_lote = u.c_id_lote ".
	  									  "WHERE c_codcatastral = '$id'");
		$consulta_VP = pg_fetch_array($consulta_ViasPuertas);
		if(!empty($consulta_VP))
			return $consulta_VP;
		else
			echo "";
	 }

	
}