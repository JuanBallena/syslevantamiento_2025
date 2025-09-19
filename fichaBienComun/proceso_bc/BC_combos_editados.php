<?php
function generaCombo($num)
{	
	//para el caso de los combbos clonados
	global $indice1;
	global $indice2;
	global $indice3;
	global $indice4;
	global $indice5;
	//para el caso de utilizar los arrays
	global $row2;
	global $row4;
	global $row6;
	global $row7;
	global $row10;
	global $row11;
	global $row12;
	global $row13;
	
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
				$iden='MFC';
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
				$name='upc_pue-'.$indice1;
				
				break;
		case 26:
				$iden='MEP';
				$name='c_mep-'.$indice2;
				break;
		case 27:
				$iden='ECS';
				$name='c_ecs-'.$indice2;
				break;
		case 28:
				$iden='ECC';
				$name='c_ecc-'.$indice2;
				break;
		case 29:
				$iden='UCA';
				$name='c_uca-'.$indice2;
				$ancho='width:40px';
				break;
		case 30:
				$iden='MEP';
				$name='oc_mep-'.$indice3;
				$ancho='width:40px';
				break;
		case 31:
				$iden='ECS';
				$name='oc_ecs-'.$indice3;
				$ancho='width:40px';
				break;
		case 32:
				$iden='ECC';
				$name='oc_ecc-'.$indice3;
				$ancho='width:40px';
				break;
		case 33:
				$iden='UCA';
				$name='oc_uca-'.$indice3;
				$ancho='width:40px';
				break;
			
		case 36:
				$iden='CNP';
				$name='upc_cond-'.$indice1;
				
				break;
		
		}
		
		if ($num==14){
		$Consulta="SELECT codi_uso AS codigo, codi_uso ||' - '|| desc_uso AS descri FROM tf_usos_bc ORDER BY codi_uso ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		
		elseif ($num==15){
		$Consulta="SELECT tf_notarias.id_notaria AS codigo, tf_notarias.nomb_notaria AS descri FROM tf_notarias ORDER BY nomb_notaria ASC"; 
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
		else{
		//relizamos consulta según las variables
		$Consulta="SELECT codigo, codigo ||' - '||  desc_codigo AS descri FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden'"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		
	//Asignamos valores por cada consulta para comparaciones en combo
	switch($num)
	{
		case 12: 
				$cad1=trim($row4['clasificacion']);
				break;
		case 13: 
				$cad1=trim($row4['cont_en']);
				break;
		case 14: 
				$cad1=trim($row4['codi_uso']);
				break;
		case 15: 
				$cad1=trim($row10['id_notaria']);
				break;
		case 16: 
				$cad1=trim($row11['tipo_partida']);
				break;
		case 17: 
				$cad1=trim($row11['codi_decla_fabrica']);
				break;
		case 18: 
				$cad1=trim($row12['cond_declarante']);
				break;
		case 19: 
				$cad1=trim($row12['esta_llenado']);
				break;
		case 20: 
				$cad1=trim($row12['mantenimiento']);
				break;
		case 21: 
				$cad1=trim($row13['supervisor']);
				break;
		case 22: 
				$cad1=trim($row13['tecnico']);
				break;
		case 23: 
				$cad1=trim($row13['verificador']);
				break;
		case 25: 
				/* Obtener el último carácter */
				$cad1=$row2['id_puerta'];
				$cad1=substr($cad1,strlen($cad1)-2,1);
				break;
		case 26:
				$cad1=trim($row6['mep']);
				break;
		case 27:
				$cad1=trim($row6['ecs']);
				break;
		case 28: 
				$cad1=trim($row6['ecc']);
				break;	
		case 29: 
				$cad1=trim($row6['uca']);
				break;
		case 30:
				$cad1=trim($row7['mep']);
				break;
		case 31:
				$cad1=trim($row7['ecs']);
				break;
		case 32: 
				$cad1=trim($row7['ecc']);
				break;	
		case 33: 
				$cad1=trim($row7['uca']);
				break;
		case 36: 
				$cad1=$row2['cond_nume'];
				break;
	
	}
	// imprimo COMBOS
	if ($num==3)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_tipo_persona(this.id)'>";
	}
	elseif ($num==5)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_estado_civil(this.id)'>";
	}
	elseif ($num==9)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_condicion_titular(this.id)'>";
	}
	elseif ($num==14)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_bloqueo_construccion(this.id)'>";
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
		echo "<select style='$ancho' class='select' name='$name' id='$name'>";
	}
		echo "<option value='0'>SELECCIONE</option>";
		while($registro=pg_fetch_assoc($consulta_combo))
		{
			//para verificar
			/*echo "<option value='".trim($registro['codigo'])."'";if(trim($registro['codigo'])==$cad1){echo " selected='true'";}echo ">".trim($registro['descri']).' -> Código:'.trim($registro['codigo']).'-> Comparado:'.$cad1.'<-'."</option>";*/
			echo "<option value='".trim($registro['codigo'])."'";if(trim($registro['codigo'])==$cad1){echo " selected='true'";}echo ">".trim($registro['descri'])."</option>";
			}
		echo "</select>";
		}//fin generaCombo



//---------------------------------------------------------------------
?>