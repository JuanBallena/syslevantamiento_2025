<?php
function generaCombo($num)
{	
	global $row2;
	global $row4;
	global $row5;
	global $row7;
	global $row8;
	
	$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BD->conectar();
		
	switch($num)
	{ 	case 1:
				$iden='TED';
				$name='upc_cmb_tipoedi';
				$ancho='width:146px';
				break;
		case 2:
				$iden='TIN';
				$name='upc_cmb_tipoint';
				$ancho='width:146px';
				break;
		case 3:
				$iden='TPE';
				$name='itc_cmb_tipotitu';
				$ancho='width:146px';
				break;
		case 4:
				$iden='DOC';
				$name='itc_cmb_tipodoc1';
				$ancho='width:146px';
				break;
		case 5:
				$iden='ECV';
				$name='itc_cmb_ecivil';
				$ancho='width:146px';
				break;
		case 6:
				$iden='TPJ';
				$name='itc_cmb_perjur';
				$ancho='width:146px';
				break;
		case 7:
				$iden='CET';
				$name='itc_cmb_condesptitu';
				$ancho='width:146px';
				break;
		case 8://ya fue
				$iden='VIA';
				$name='dftc_cmb_tipovia';
				$ancho='width:146px';
				break;
		case 9:
				$iden='CTT';
				$name='ct_cmb_condtitu';
				$ancho='width:146px';
				break;
		case 10:
				$iden='FAQ';
				$name='ct_cmb_formadq';
				$ancho='width:146px';
				break;
		case 11:
				$iden='CEP';
				$name='ct_cmb_condesppre';
				$ancho='width:146px';
				break;
		case 12:
				$iden='CDP';
				$name='dp_cmb_claspre';
				$ancho='width:146px';
				break;
		case 13:
				$iden='PEN';
				$name='dp_cmb_precat';
				$ancho='width:146px';
				break;
		case 14:
				$name='dp_cmb_usoprecat';
				$ancho='width:146px';
				break;
		case 15:
				$name='d_cmb_nomnot';
				$ancho='width:146px';
				break;
		case 16:
				$iden='TPA';
				$name='ipcrp_cmb_tipoparreg';
				$ancho='width:146px';
				break;
		case 17:
				$iden='DFB';
				$name='ipcrp_cmb_decfab';
				$ancho='width:146px';
				break;
		case 18:
				$iden='CDE';
				$name='ic_cmb_conddec';
				$ancho='width:146px';
				break;
		case 19:
				$iden='LLE';
				$name='ic_cmb_estficha';
				$ancho='width:146px';
				break;
		case 20:
				$iden='MFE';
				$name='ic_cmb_man';
				$ancho='width:146px';
				break;
		case 21:
				
				$name='f_cmb_sup';
				$ancho='width:146px';
				break;
		case 22:
				
				$name='f_cmb_tec';
				$ancho='width:146px';
				break;
		case 23:
				
				$name='f_cmb_ver';
				$ancho='width:146px';
				break;
		case 24:
				$iden='DOC';
				$name='itc_cmb_tipodoc2';
				$ancho='width:146px';
				break;
		case 25:
				$iden='TPR';
				$name='upc_pue-0';
				
				break;
		case 26:
				$iden='MEP';
				$name='c_mep-0';
				break;
		case 27:
				$iden='ECS';
				$name='c_ecs-0';
				break;
		case 28:
				$iden='ECC';
				$name='c_ecc-0';
				break;
		case 29:
				$iden='UCA';
				$name='c_uca-0';
				$ancho='width:35px';
				break;
		case 30:
				$iden='MEP';
				$name='oc_mep-0';
				$ancho='width:40px';
				break;
		case 31:
				$iden='ECS';
				$name='oc_ecs-0';
				$ancho='width:40px';
				break;
		case 32:
				$iden='ECC';
				$name='oc_ecc-0';
				$ancho='width:40px';
				break;
		case 33:
				$iden='UCA';
				$name='oc_uca-0';
				$ancho='width:40px';
				break;
		case 34:
				$iden='TDC';
				$name='d_tipo-0';
				$ancho='width:350px';
				break;
		case 35:
				$iden='DOC';
				$name='ic_tipo-0';
				$ancho='width:165px';
				break;
		case 36:
				$iden='CNP';
				$name='upc_cond-0';
				
				break;
		//para ECONOMICAS
		case 41:
				$iden='CDC';
				$name='ic_cmb_condcon';
				$ancho='width:146px';
				break;
		case 42:
				$name='amf_cmb_actividad-0';
				$ancho='width:870px';
				break;
		case 43:
				$iden='ANU';
				$name='aa_cmb_anuncio-0';
				$ancho='width:175px';
				break;
		case 44:
				$iden='TPE';
				$name='ic_cmb_tipocon';
				$ancho='width:146px';
				break;
		case 45:
				$iden='DOC';
				$name='ic_cmb_tipoide';
				$ancho='width:146px';
				break;
		case 46:
				$iden='DFE';
				$name='ic_cmb_docpre';
				$ancho='width:146px';
				break;
		}
		
		if ($num==14){
		$Consulta="SELECT tf_usos.codi_uso, tf_usos.codi_uso ||' - '||  tf_usos.desc_uso FROM tf_usos ORDER BY codi_uso ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		
		elseif ($num==15){
		$Consulta="SELECT tf_notarias.id_notaria, tf_notarias.nomb_notaria FROM tf_notarias ORDER BY nomb_notaria ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==21){
		$Consulta="SELECT id_persona AS codigo, nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri FROM tf_personas WHERE tipo_funcion='2' ORDER BY ape_paterno, ape_materno, nombres ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==22){
		$Consulta="SELECT id_persona AS codigo, nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri FROM tf_personas WHERE tipo_funcion='3' ORDER BY ape_paterno, ape_materno, nombres ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==23){
		$Consulta="SELECT id_persona AS codigo, nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri FROM tf_personas WHERE tipo_funcion='4' ORDER BY ape_paterno, ape_materno, nombres ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==42){
		$Consulta="SELECT codi_actividad AS codigo, codi_actividad ||' - '||  desc_actividad AS descri FROM tf_actividades ORDER BY codi_actividad ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		else{
		//relizamos consulta según las variables
		$Consulta="SELECT codigo, codigo ||' - '||  desc_codigo as descri FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden'"; 
	$consulta_combo = $BD->Consultas($Consulta);

		}
		
	// imprimo COMBOS
	if ($num==3)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:cargar_tipo_persona(this.id)'>";
	}
	elseif ($num==5)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:cargar_estado_civil(this.id)'>";
	}
	elseif ($num==9)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:cargar_condicion_titular(this.id)'>";
	}
	elseif ($num==14)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:cargar_bloqueo_construccion(this.id)'>";
	}
	elseif ($num==26 || $num==27  || $num==28)
	{
		echo "<select class='select' name='$name' id='$name' style='width:43px'>";
	}
	elseif ($num==25)
	{
		echo "<select class='select' name='$name' id='$name' style='width:110px'>";
	}
	elseif ($num==30 || $num==31  || $num==32)
	{
		echo "<select class='select' name='$name' id='$name' style='width:51px'>";
	}
	elseif ($num==36)
	{
		echo "<select class='select' name='$name' id='$name' style='width:95px'>";
	}
	else
	{
		//si no hay variantes el el SELECT
		if ($num==18)
		{
			$cad1=trim($row7['cond_declarante']);
		}
		
		if ($num==19)
		{
			$cad1=trim($row7['esta_llenado']);
		}
		
		if ($num==20)
		{
			$cad1=trim($row7['mantenimiento']);
		}
		
		if ($num==21 || $num==22  || $num==23)
		{
			if($num==21) $cad1=trim($row8['supervisor']);
			
			if($num==22) $cad1=trim($row8['tecnico']);
			
			if($num==23) $cad1=trim($row8['verificador']);
			
		}
		
		if ($num==41)
		{
			$cad1=trim($row2['cond_conductor']);
		}
		
		if ($num==42)
		{
			$cad1=trim($row4['codi_actividad']);
		}
		
		if ($num==43)
		{
			$cad1=trim($row5['codi_anuncio']);
		}
		
		if ($num==44)
		{
			$cad1=trim($row2['tipo_persona']);
		}
		
		if ($num==45)
		{
			$cad1=trim($row2['tipo_doc']);
		}
		
		if ($num==46)
		{
			$cad1=trim($row7['docu_presentado']);
		}
		
		//COMBO INICIO	
		echo "<select style='$ancho' class='select' name='$name' id='$name'>";
		

	}
		echo "<option value='0'>SELECCIONE</option>";
		while($registro=pg_fetch_assoc($consulta_combo))
			{
				echo "<option value='".trim($registro['codigo'])."'";if(trim($registro['codigo'])==$cad1){echo " selected='true'";}echo ">".trim($registro['descri']).' -> Código:'.trim($registro['codigo']).'-> Comparado:'.$cad1.'<-'."</option>";
			}
		echo "</select>";
			
	
}//fin generaCombo



//---------------------------------------------------------------------
?>