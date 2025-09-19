<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Vias_p
{
	

    public $IdVia;
    public $Id_Via;
    public $Nom_Via;
    public $Tip_Via;
    public $Cod_Via;
    public $IdUbigeo;
    public $Id_Sys_Via;

	 //Verifica si tiene c_id_uni_cat en la tabla tf_ficha
	 public function ObtenerViasPuertas($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_ViasPuertas = $BD->Consultas("SELECT distinct c_id_uni_cat, c_tip_via, c_cod_via, c_id_via  ".										  	   									
		  								  "FROM tf_puertas ".
	  									  "WHERE c_id_uni_cat = '$id'");
		$consulta_VP = pg_fetch_all($consulta_ViasPuertas);
		if(!empty($consulta_VP))
			return $consulta_VP;
		else
			echo "";
	 }

	 public function ObtenerPuertas($idUniCat, $idVia)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_Puertas = $BD->Consultas("SELECT c_id_uni_cat, i_tipo_puerta, c_nume_muni, c_tip_via, c_cod_via,i_codi_puerta ".										  	  								  	   									
		  								  "FROM tf_puertas ".
	  									  "WHERE c_id_uni_cat = '$idUniCat' and c_id_via = '$idVia'");
		$consulta_VP = pg_fetch_all($consulta_Puertas);
		if(!empty($consulta_VP))
			return $consulta_VP;
		else
			echo "";
	 }
	
}