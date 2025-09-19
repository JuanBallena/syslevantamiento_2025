<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Fichas_p
{
    public $c_id_uni_cat;
    public $c_id_via;
    public $c_id_sector;
    public $c_manzana;
    public $c_lote;
    public $c_sublote;
    public $c_id_hab_urba;
    public $i_num_etapa;
    public $c_id_usuario;
    public $c_codi_uso;
    public $c_codcatastral;
    public $i_cod_tipo_muros;
    public $i_cod_tipo_techos;
    public $i_cod_tipo_puertas;
    public $i_cod_tip_material;
    public $i_nro_piso;
    public $i_cod_est_unid;
    public $c_nom_archivo;
	//public $c_tipoZCE;

	//Verifica si tiene c_id_uni_cat en la tabla tf_ficha
	 public function ObtenerFichaNueva($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT substring(c_id_uni_cat,21,3), c_id_uni_cat, c_id_sector, c_manzana, c_lote, c_sublote, ".
	  									  "c_id_hab_urba, i_num_etapa, c_id_usuario,c_codi_uso, c_codcatastral, ".
										  "c_tipozce, c_id_construccion, i_cod_est_unid, d_fecha, c_ruta_imagen,c_referencial_uso ".	   									
		  								  "FROM tf_ficha ".
	  									  "WHERE c_codcatastral = '$id'");
		$consulta_UC = pg_fetch_array($consulta_UniCata);//esto devuelve un solo registro? debe devolver dos registros
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }

	 public function ObtenerFichaNueva_Principal($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT substring(c_id_uni_cat,21,3), c_id_uni_cat, c_id_sector, c_manzana, c_lote, c_sublote, ".
	  									  "c_id_hab_urba, i_num_etapa, c_id_usuario,c_codi_uso, c_codcatastral, ".
										  "c_tipozce, c_id_construccion, i_cod_est_unid, d_fecha, c_ruta_imagen,c_referencial_uso ".	   									
		  								  "FROM tf_ficha ".
	  									  "WHERE c_codcatastral = '$id' and substring(c_id_uni_cat,21,3) = '001' ");
		$consulta_UC = pg_fetch_array($consulta_UniCata);//esto devuelve un solo registro? debe devolver dos registros
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }

	 public function ObtenerFichaNueva_Busqueda($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT substring(c_id_uni_cat,21,3), c_id_uni_cat, c_id_sector, c_manzana, c_lote, c_sublote, ".
	  									  "c_id_hab_urba, i_num_etapa, c_id_usuario,c_codi_uso, c_codcatastral, ".
										  "c_tipozce, c_id_construccion, i_cod_est_unid, d_fecha, c_ruta_imagen,c_referencial_uso ".	   									
		  								  "FROM tf_ficha ".
	  									  "WHERE c_codcatastral = '$id'");
		$consulta_UC = pg_fetch_all($consulta_UniCata);
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }

	 //Verifica si tiene c_id_uni_cat en la tabla tf_ficha por unidades
	 public function ObtenerFichaNueva_Unidades($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT substr(c_id_uni_cat,21,3), c_id_uni_cat, c_id_sector, c_manzana, c_lote, c_sublote, ".
	  									  "c_id_hab_urba, i_num_etapa, c_id_usuario,c_codi_uso, c_codcatastral, ".
										  "c_tipozce, c_id_construccion, i_cod_est_unid, d_fecha, c_ruta_imagen,c_referencial_uso ".	   									
		  								  "FROM tf_ficha ".
	  									  "WHERE c_id_uni_cat = '$id'");
		$consulta_UC = pg_fetch_array($consulta_UniCata);
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }
	
	//Verifica si tiene Posibles unidades en la tabla 
	public function ObtenerPosiblesUnidades($id)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();
	    $Consulta="SELECT * FROM tf_informacion_complementaria ".
				  "WHERE i_subdivision = 1 and c_id_uni_cat = '$id'";
	    $consulta_PosibUnidades=$BD->Consultas($Consulta);
		$consulta_PU = pg_fetch_array($consulta_PosibUnidades);
		if(!empty($consulta_PU))
			return $consulta_PU;
		else
			echo "";
	    
	 }

	 //verifica si existe esa unidad
	 public function validaUnidad($unidad,$codCatastral)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();
	    $Consulta="SELECT c_id_uni_cat FROM tf_ficha ".
				  "WHERE substr(c_id_uni_cat,21,3) = '$unidad' AND c_codcatastral = '$codCatastral'";
	    $consulta_PosibUnidades=$BD->Consultas($Consulta);
		$consulta_PU = pg_fetch_array($consulta_PosibUnidades);
		if(!empty($consulta_PU))
			return $consulta_PU;
		else
			echo "";
	    
	 }

	 //contar filas de ficha
	 public function ContarFilasFichas($codCata)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();
	    $Consulta="SELECT count(*) as contador FROM tf_ficha ".
				  "WHERE c_codcatastral = '$codCata'";
	    $consulta_PosibUnidades=$BD->Consultas($Consulta);
		$consulta_PU = pg_fetch_array($consulta_PosibUnidades);	
		//echo $consulta_PU[0];
		if(!empty($consulta_PU))
			return $consulta_PU[0];
		else
			echo "";
	    
	 }

}