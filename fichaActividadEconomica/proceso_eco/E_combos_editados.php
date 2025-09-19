<?php
function generaCombo($num)
{	
	//para el caso de los combbos clonados
	global $indice1;
	global $indice2;
	//para el caso de utilizar los arrays
	global $row2;
	global $row4;
	global $row5;
	global $row7;
	global $row8;
	
	$BD=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);
	$BD->conectar();
		
	switch($num)
	{ 	
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
		
		//para ECONOMICAS
		case 41:
				$iden='CDC';
				$name='ic_cmb_condcon';
				$ancho='width:146px';
				break;
		case 42:
				$name='amf_cmb_actividad-'.$indice1;
				$ancho='width:870px';
				break;
		case 43:
				$iden='ANU';
				$name='aa_cmb_anuncio-'.$indice2;
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
		
		//consultas de combos personalizados
		if ($num==21){
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
		//relizamos consulta POR DEFECTO según las variables
		$Consulta="SELECT codigo, codigo ||' - '||  desc_codigo as descri FROM tf_tablas, tf_tablas_codigos ".
				"WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden' ".
				"ORDER BY codigo, descri"; 
	$consulta_combo = $BD->Consultas($Consulta);

		}
		
	//Asignamos valores por cada consulta para comparaciones en combo
	switch($num)
	{
		case 18: 
				$cad1=trim($row7['cond_declarante']);
				break;
		case 19: 
				$cad1=trim($row7['esta_llenado']);
				break;
		case 20: 
				$cad1=trim($row7['mantenimiento']);
				break;
		case 21: 
				$cad1=trim($row8['supervisor']);
				break;
		case 22: 
				$cad1=trim($row8['tecnico']);
				break;
		case 23: 
				$cad1=trim($row8['verificador']);
				break;
		case 41: 
				$cad1=trim($row2['cond_conductor']);
				break;
		case 42: 
				$cad1=trim($row4['codi_actividad']);
				break;
		case 43: 
				$cad1=trim($row5['codi_anuncio']);
				break;
		case 44: 
				$cad1=trim($row2['tipo_persona']);
				break;
		case 45: 
				$cad1=trim($row2['tipo_doc']);
				break;
		case 46: 
				$cad1=trim($row7['docu_presentado']);
				break;
	
	}
	
	if ($num==44)
	{
		//COMBO personalizado
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:define_tipo(this.id);'>";
	}
	elseif ($num==45)
	{
		//COMBO personalizado
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:pasa_nrodoc(this.id);'>";
	}
	else
	{
		//COMBO normal
		echo "<select style='$ancho' class='select' name='$name' id='$name'>";
	}
		
		
		echo "<option value='0'>SELECCIONE</option>";
		while($registro=pg_fetch_assoc($consulta_combo))
		{
			/* //para verificar datos
			echo "<option value='".trim($registro['codigo'])."'";if(trim($registro['codigo'])==$cad1){echo " selected='true'";}echo ">".trim($registro['descri']).' -> Código:'.trim($registro['codigo']).'-> Comparado:'.$cad1.'<-'."</option>";*/
			echo "<option value='".trim($registro['codigo'])."'";if(trim($registro['codigo'])==$cad1){echo " selected='true'";}echo ">".trim($registro['descri'])."</option>";
			}
		echo "</select>";
		}//fin generaCombo



//---------------------------------------------------------------------
?>