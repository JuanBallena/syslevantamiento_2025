<?php 
	session_start();

	require_once 'I_variables.php';
	require_once 'I_verificar_insertar.php';

	// NRO DE INDIVIDUALES INICIALIZAMOS EN CERO
	$bc=0;
	
	//Se Obtienen PRINCIPALES ID
	$TF='01';
	$anio=date("Y");
	$ubigeo='130101';
	$IDSector=$ubigeo.$dg_sector;
	//echo  ($IDSector);
	$IDManzana=$IDSector.$dg_manzana;
	//echo($IDManzana);
	//$IDLote=$IDManzana.$dg_lote;
	$IDLote='2813010103017028';
	//echo $IDLote;
	$IDEdificacion=$IDLote.$dg_edificacion;
	$upc_codhu='00001';
	$IDHabUrb=$ubigeo.$upc_codhu;
	//echo($IDHabUrb);
	$IDUniCat=$IDEdificacion.$dg_entrada.$dg_piso.$dg_unidad;
	//echo($IDUniCat);
	$IDFicha=$ubigeo.$dg_sector.$dg_manzana.$dg_lote.$dg_edificacion.$dg_entrada.$dg_piso.$dg_unidad;
	//echo($IDFicha);
	$NumFLote=$numflote1.'-'.$numflote2;
	//echo($NumFLote);
	
	//$IDUsuario=$_SESSION['id_usuario'];	
	$IDUsuario='70142734';	


	//CONTADOR DE INDIVIDUALES : C�digo Referencial -> hasta LOTE
	$cod_ref=substr($IDUniCat,0,14);

	//---------------------------------------------------------- SECTOR -----------------------------------------------------
	/*echo "<script>alert('TF_MANZANA');</script>\n";*/
	$Seleccion="SELECT c_id_sector FROM tf_sectores WHERE c_id_sector='$IDLote'";
	$Insercion="INSERT INTO tf_sectores VALUES('$IDLote','$ubigeo','$dg_sector','$dg_sector')";
	ejecuta_consulta($Seleccion,$Insercion);
	
	//---------------------------------------------------------- MANZANAS -----------------------------------------------------
	/*echo "<script>alert('TF_MANZANA');</script>\n";*/
	$Seleccion="SELECT c_id_mzna FROM tf_manzanas WHERE c_id_mzna='$IDManzana'";
	$Insercion="INSERT INTO tf_manzanas VALUES('$IDManzana','$IDSector','$dg_manzana','$upc_mzna')";
	ejecuta_consulta($Seleccion,$Insercion);


	//----------------------------------------------------------- LOTES -----------------------------------------------------
	/*echo "<script>alert('TF_LOTE');</script>\n";*/
	$Seleccion="SELECT c_id_lote FROM tf_lotes WHERE c_id_lote='$IDLote'";
	$Insercion="INSERT INTO tf_lotes VALUES('$IDLote','$IDManzana','$dg_lote','$upc_codhu','$upc_mzna',".
											"'$upc_lote','$upc_sublote')";
	ejecuta_consulta($Seleccion,$Insercion);
	
	//---------------------------------------------------------- VIAS -----------------------------------------------------
	/*echo "<script>alert('TF_VIA');</script>\n";*/
	//echo $nro_vias; echo ' ';
	$tipoVia = 01;
	
	for($i=0;$i<$nro_vias;$i++) 
	{	
		//$IDVia=$ubigeo.$upc_codvia[$i];
		$IDVia='13010100001';
		$IDPuerta=$IDLote.$upc_codpue[$i].$i;

		//----------------------------------------------------- PUERTAS ------------------------------ 
		/*echo "<script>alert('TF_PUERTAS');</script>\n";*/
		//echo $IDPuerta;
		$tipoPuerta="SELECT codigo FROM tf_tablas, tf_tablas_codigos ".
							"WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla ".
							"AND tf_tablas.id_tabla = 'TPR' AND codigo='$upc_codpue[$i]'";
		$tpuerta=$BaseDato->Consultas($tipoPuerta); 
		while($row=pg_fetch_row($tpuerta)) $tipoPuerta=trim($row[0]);
		
		$Seleccion="SELECT c_id_puerta FROM tf_puertas WHERE c_id_puerta='$IDPuerta'";
		$Insercion="INSERT INTO tf_puertas VALUES('$IDPuerta','$IDLote','$upc_codpue[$i]',".
				   "'$tipoPuerta','$upc_num[$i]','$IDVia','$tipoVia')";
		ejecuta_consulta($Seleccion,$Insercion);
	}
	
	//---------------------------------------------------- UNIDAD CATASTRAL -----------------------------------------------------
	/*echo "<script>alert('TF_UNI_CAT');</script>\n";*/
	$Seleccion="SELECT c_id_uni_cat FROM tf_uni_cat WHERE c_id_uni_cat='$IDUniCat'";
	$Insercion="INSERT INTO tf_uni_cat VALUES('$IDUniCat','$IDLote','$dg_entrada','$dg_piso',".
			   "'$dg_unidad','$dg_edificacion')";
	ejecuta_consulta($Seleccion,$Insercion);
	
	//---------------------------------------------------------- FICHA -----------------------------------------------------
	//Grabamos Ficha
	$imagen='hola.txt';
	$Seleccion="SELECT c_id_uni_cat FROM tf_fichas WHERE c_id_uni_cat='$IDFicha'";
	$Insercion="INSERT INTO tf_fichas VALUES('$IDUniCat','$IDVia','$IDSector','$upc_mzna','$upc_lote','$upc_sublote',". 
			   "'$dg_dep','$dg_pro','$dg_dis','$IDHabUrb','$upc_nomzse', '$IDUsuario','$dp_cmb_usoprecat','$imagen',".
			   "'$dg_codcatastral','$upc_zse','$cmb_tipo_myc','$cmb_tipo_techo','$cmb_tipo_pisos','$cmb_tipo_material',".
			   "'$dftc_nroPiso','$upc_cmb_estado_unidad')";
	ejecuta_consulta($Seleccion,$Insercion);


	//------------------------------------------------------------- SERVICIOS B�SICOS -------------------------------------------
	/*echo "<script>alert('TF_SERVICIOS_BASICOS');</script>\n";*/
	$Seleccion="SELECT c_id_uni_cat FROM tf_servicios_basicos WHERE c_id_uni_cat='$IDFicha'";
	$Insercion="INSERT INTO tf_servicios_basicos VALUES('$IDFicha',".
				"'$sb_luz','$sb_agua','$sb_telefono','$sb_desague')";				
	ejecuta_consulta($Seleccion,$Insercion);
	
	//------------------------------------------------------------- CONSTRUCCIONES ------------------------------------------------
	/*echo "<script>alert('TF_CONSTRUCCIONES');</script>\n";*/
	for($i=0;$i<$nro_cons;$i++) 
	{	
		//buscamos el �ltimo c�digo de la ficha	
		$Consulta="SELECT codi_construccion FROM tf_construcciones WHERE c_id_uni-cat='$IDFicha'".
					" ORDER BY id_ficha, id_construccion desc limit 1"; 
		$Busqueda = $BaseDato->Consultas($Consulta);
		$registro=pg_fetch_row($Busqueda);
		
		// se recupera el ultimo id
		$ultimoid = $registro[0]; 
		$ultimoid = $ultimoid + 1;
		$IDConstruccion=$IDFicha.$c_psm[$i].(string)$ultimoid;
		/*$Seleccion="SELECT id_construccion FROM tf_construcciones WHERE id_ficha='$IDFicha'".
					" AND nume_piso='$c_psm[$i]' AND mep='$c_mep[$i]'";*/
		$Insercion="INSERT INTO tf_construcciones VALUES('$IDConstruccion','$IDFicha','$dftc_nroPiso','$c_fecha'".
					"$c_myc[$i]','$c_t[$i]','$c_p[$i]','$c_pyv[$i]','$c_mep[$i]')";
		//ejecuta_consulta($Seleccion,$Insercion);
		//INSERTAMOS 
		$Resultado=$BaseDato->Consultas($Insercion);      
		if(pg_affected_rows($Resultado)>=0)//Si resulto al menos una fila afectada
		{	
			/*echo "<script>alert('Grabamos');</script>\n";*/
		}
	}
	
		
	//----------------------------------------------------- INFORMACION COMPLEMENTARIA ------------------------------------------------

		$Seleccion="SELECT c_id_uni_cat FROM tf_informacion_complementaria WHERE c_id_uni_cat='$IDFicha'";
					
		$Insercion="INSERT INTO tf_informacion_complementaria VALUES('$IDFicha','$i_medidores','$c_observaciones',".
					"'$c_tipo_unidad_1','$c_tipo_unidad_2','$c_tipo_unidad_3')";
		ejecuta_consulta($Seleccion,$Insercion);
	
// FIN DE FUNCION PRINCIPAL

?>

