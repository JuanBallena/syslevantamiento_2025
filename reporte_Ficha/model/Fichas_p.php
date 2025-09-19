<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Fichas_p
{
    public $c_id_uni_cat;
    public $c_id_via;
    public $c_id_sector;
    public $c_manzana;


	 public function ReportexReferencia($sector,$unidad)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT f.c_id_uni_cat, c_manzana, c_lote, c_sublote,u.c_codi_uso, ".
										   "eu.c_des_est_unid, f.c_nombre_hu, c_tipozce, i_num_etapa,u.c_desc_uso,f.d_fecha, ".
									       "f.c_referencial_uso,sb.c_luz, sb.c_agua, sb.c_telefono, sb.c_desague, sb.c_gas, p.c_desc_pisos as pisos, ".
										   "tc.c_des_tip_categoria as muro,tc1.c_des_tip_categoria as techo,tc2.c_des_tip_categoria as piso,tc3.c_des_tip_categoria as puerta, ".
										   "tm.c_des_tip_material as material, ic.i_medidores, ic.c_observaciones, ic.i_subdivision, ic.i_acumulacion, ic.i_independizacion,f.c_ruta_imagen, ".
										   "pu.c_tip_via,pu.c_cod_via,tv.c_desc_tipo_via,pu.c_nombre_via, pu.i_tipo_puerta,pu.c_nume_muni, ".
										   "us.c_nombres || ' ' || c_ape_paterno || ' ' || c_ape_materno as usuario ".
										   "FROM tf_ficha f ".
										   "inner join tf_estado_unidad eu on eu.i_cod_est_unid = f.i_cod_est_unid ".
										   "inner join tf_usos u on u.c_codi_uso = f.c_codi_uso ".
									       "inner join tf_servicios_basicos sb on sb.c_id_uni_cat = f.c_id_uni_cat ".
										   "inner join tf_construcciones c on c.c_id_uni_cat = f.c_id_uni_cat ".
										   "inner join tf_pisos p on p.c_cod_pisos = c.c_nume_piso ".
										   "inner join tf_tipo_categoria tc on tc.i_cod_tip_categoria = c.i_estr_muro_col ".
										   "inner join tf_tipo_categoria tc1 on tc1.i_cod_tip_categoria = c.i_estr_techo ".    
										   "inner join tf_tipo_categoria tc2 on tc2.i_cod_tip_categoria = c.i_acab_piso ".        
										   "inner join tf_tipo_categoria tc3 on tc3.i_cod_tip_categoria = c.i_acab_puerta ".
										   "inner join tf_tipo_material tm on tm.i_cod_tip_material = c.i_mep ".
										   "inner join tf_informacion_complementaria ic on ic.c_id_uni_cat = f.c_id_uni_cat ".
										   "inner join tf_usuario us on us.c_id_usuario = f.c_id_usuario ".
										   "inner join tf_puertas pu on pu.c_id_uni_cat = f.c_id_uni_cat ".	
										   "inner join tf_tipo_via tv on tv.c_cod_tipo_via = pu.c_tip_via ". 									
			  							   "WHERE substring(f.c_id_uni_cat, 7,2) = '$sector' or substring(f.c_id_uni_cat, 9,3)= '$unidad'"); 
		$consulta_UC = pg_fetch_all($consulta_UniCata);
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }

	 public function ReportexUbicacion($estado,$hu)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT f.c_id_uni_cat, c_manzana, c_lote, c_sublote,u.c_codi_uso, ".
											"eu.c_des_est_unid, f.c_nombre_hu, c_tipozce, i_num_etapa,u.c_desc_uso,f.d_fecha, ".
											"f.c_referencial_uso,sb.c_luz, sb.c_agua, sb.c_telefono, sb.c_desague, sb.c_gas, p.c_desc_pisos as pisos, ".
											"tc.c_des_tip_categoria as muro,tc1.c_des_tip_categoria as techo,tc2.c_des_tip_categoria as piso,tc3.c_des_tip_categoria as puerta, ".
											"tm.c_des_tip_material as material, ic.i_medidores, ic.c_observaciones, ic.i_subdivision, ic.i_acumulacion, ic.i_independizacion,f.c_ruta_imagen, ".
											"pu.c_tip_via,pu.c_cod_via,tv.c_desc_tipo_via,pu.c_nombre_via, pu.i_tipo_puerta,pu.c_nume_muni, ".
											"us.c_nombres || ' ' || c_ape_paterno || ' ' || c_ape_materno as usuario ".
											"FROM tf_ficha f ".
											"inner join tf_estado_unidad eu on eu.i_cod_est_unid = f.i_cod_est_unid ".
											"inner join tf_usos u on u.c_codi_uso = f.c_codi_uso ".
											"inner join tf_servicios_basicos sb on sb.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_construcciones c on c.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_pisos p on p.c_cod_pisos = c.c_nume_piso ".
											"inner join tf_tipo_categoria tc on tc.i_cod_tip_categoria = c.i_estr_muro_col ".
											"inner join tf_tipo_categoria tc1 on tc1.i_cod_tip_categoria = c.i_estr_techo ".    
											"inner join tf_tipo_categoria tc2 on tc2.i_cod_tip_categoria = c.i_acab_piso ".        
											"inner join tf_tipo_categoria tc3 on tc3.i_cod_tip_categoria = c.i_acab_puerta ".
											"inner join tf_tipo_material tm on tm.i_cod_tip_material = c.i_mep ".
											"inner join tf_informacion_complementaria ic on ic.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_usuario us on us.c_id_usuario = f.c_id_usuario ".
											"inner join tf_puertas pu on pu.c_id_uni_cat = f.c_id_uni_cat ".	
											"inner join tf_tipo_via tv on tv.c_cod_tipo_via = pu.c_tip_via ".   									
			  							    "WHERE eu.i_cod_est_unid = '$estado' or substring(f.c_id_hab_urba, 7,5)= '$hu'"); 
		$consulta_UC = pg_fetch_all($consulta_UniCata);
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }
	public function ReportexDescripcion($uso)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT f.c_id_uni_cat, c_manzana, c_lote, c_sublote,u.c_codi_uso, ".
											"eu.c_des_est_unid, f.c_nombre_hu, c_tipozce, i_num_etapa,u.c_desc_uso,f.d_fecha, ".
											"f.c_referencial_uso,sb.c_luz, sb.c_agua, sb.c_telefono, sb.c_desague, sb.c_gas, p.c_desc_pisos as pisos, ".
											"tc.c_des_tip_categoria as muro,tc1.c_des_tip_categoria as techo,tc2.c_des_tip_categoria as piso,tc3.c_des_tip_categoria as puerta, ".
											"tm.c_des_tip_material as material, ic.i_medidores, ic.c_observaciones, ic.i_subdivision, ic.i_acumulacion, ic.i_independizacion,f.c_ruta_imagen, ".
											"pu.c_tip_via,pu.c_cod_via,tv.c_desc_tipo_via,pu.c_nombre_via, pu.i_tipo_puerta,pu.c_nume_muni, ".
											"us.c_nombres || ' ' || c_ape_paterno || ' ' || c_ape_materno as usuario ".
											"FROM tf_ficha f ".
											"inner join tf_estado_unidad eu on eu.i_cod_est_unid = f.i_cod_est_unid ".
											"inner join tf_usos u on u.c_codi_uso = f.c_codi_uso ".
											"inner join tf_servicios_basicos sb on sb.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_construcciones c on c.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_pisos p on p.c_cod_pisos = c.c_nume_piso ".
											"inner join tf_tipo_categoria tc on tc.i_cod_tip_categoria = c.i_estr_muro_col ".
											"inner join tf_tipo_categoria tc1 on tc1.i_cod_tip_categoria = c.i_estr_techo ".    
											"inner join tf_tipo_categoria tc2 on tc2.i_cod_tip_categoria = c.i_acab_piso ".        
											"inner join tf_tipo_categoria tc3 on tc3.i_cod_tip_categoria = c.i_acab_puerta ".
											"inner join tf_tipo_material tm on tm.i_cod_tip_material = c.i_mep ".
											"inner join tf_informacion_complementaria ic on ic.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_usuario us on us.c_id_usuario = f.c_id_usuario ".
											"inner join tf_puertas pu on pu.c_id_uni_cat = f.c_id_uni_cat ".	
											"inner join tf_tipo_via tv on tv.c_cod_tipo_via = pu.c_tip_via ".  									
			  							    "WHERE u.c_codi_uso = '$uso'"); 
		$consulta_UC = pg_fetch_all($consulta_UniCata);
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }
	public function ReportexDatoTecnico($usuario,$fecha)
	 {
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();			
	    $consulta_UniCata = $BD->Consultas("SELECT f.c_id_uni_cat, c_manzana, c_lote, c_sublote,u.c_codi_uso, ".
											"eu.c_des_est_unid, f.c_nombre_hu, c_tipozce, i_num_etapa,u.c_desc_uso,f.d_fecha, ".
											"f.c_referencial_uso,sb.c_luz, sb.c_agua, sb.c_telefono, sb.c_desague, sb.c_gas, p.c_desc_pisos as pisos, ".
											"tc.c_des_tip_categoria as muro,tc1.c_des_tip_categoria as techo,tc2.c_des_tip_categoria as piso,tc3.c_des_tip_categoria as puerta, ".
											"tm.c_des_tip_material as material, ic.i_medidores, ic.c_observaciones, ic.i_subdivision, ic.i_acumulacion, ic.i_independizacion,f.c_ruta_imagen, ".
											"pu.c_tip_via,pu.c_cod_via,tv.c_desc_tipo_via,pu.c_nombre_via, pu.i_tipo_puerta,pu.c_nume_muni, ".
											"us.c_nombres || ' ' || c_ape_paterno || ' ' || c_ape_materno as usuario ".
											"FROM tf_ficha f ".
											"inner join tf_estado_unidad eu on eu.i_cod_est_unid = f.i_cod_est_unid ".
											"inner join tf_usos u on u.c_codi_uso = f.c_codi_uso ".
											"inner join tf_servicios_basicos sb on sb.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_construcciones c on c.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_pisos p on p.c_cod_pisos = c.c_nume_piso ".
											"inner join tf_tipo_categoria tc on tc.i_cod_tip_categoria = c.i_estr_muro_col ".
											"inner join tf_tipo_categoria tc1 on tc1.i_cod_tip_categoria = c.i_estr_techo ".    
											"inner join tf_tipo_categoria tc2 on tc2.i_cod_tip_categoria = c.i_acab_piso ".        
											"inner join tf_tipo_categoria tc3 on tc3.i_cod_tip_categoria = c.i_acab_puerta ".
											"inner join tf_tipo_material tm on tm.i_cod_tip_material = c.i_mep ".
											"inner join tf_informacion_complementaria ic on ic.c_id_uni_cat = f.c_id_uni_cat ".
											"inner join tf_usuario us on us.c_id_usuario = f.c_id_usuario ".
											"inner join tf_puertas pu on pu.c_id_uni_cat = f.c_id_uni_cat ".	
											"inner join tf_tipo_via tv on tv.c_cod_tipo_via = pu.c_tip_via ".   									
										    "WHERE us.c_usuario = '$usuario' or d_fecha= '$fecha'"); 
		$consulta_UC = pg_fetch_all($consulta_UniCata);
		if(!empty($consulta_UC))
			return $consulta_UC;
		else
			echo "";
	 }

	 

}