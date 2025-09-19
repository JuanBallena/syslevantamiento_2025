<?php
function generaCombo($num,$indice)
{	
	//para el caso de utilizar los arrays
	global $row2;
	global $row3;
	global $row4;
	
	
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
		
		//para cotitulares
		case 37:
				$iden='DOC';
				$name='itc_cmb_tipodoc-'.$indice;
				$ancho='width:146px';
				break;
		case 38:
				$iden='TPE';
				$name='itc_cmb_tipotitu-'.$indice;
				$ancho='width:146px';
				break;
		case 39:
				$iden='FAQ';
				$name='ct_cmb_formadq-'.$indice;
				$ancho='width:146px';
				break;
		case 40:
				$iden='CET';
				$name='itc_cmb_condesptitu-'.$indice;
				$ancho='width:146px';
				break;
		}
		
		if ($num==21){
		$Consulta="SELECT id_persona AS codigo, nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri FROM tf_personas WHERE tipo_funcion='2'".
					" ORDER BY ape_paterno, ape_materno, nombres ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==22){
		$Consulta="SELECT id_persona AS codigo, nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri FROM tf_personas WHERE tipo_funcion='3' ".
					"ORDER BY ape_paterno, ape_materno, nombres ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==23){
		$Consulta="SELECT id_persona AS codigo, nume_doc ||' - '|| nombres ||' '|| ape_paterno ||' '|| ape_materno AS descri FROM tf_personas WHERE tipo_funcion='4' ".
					"ORDER BY ape_paterno, ape_materno, nombres ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		else{
		//relizamos consulta según las variables
		$Consulta="SELECT codigo, codigo ||' - '||  desc_codigo AS descri FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND ".
				"tf_tablas.id_tabla = '$iden' ORDER BY codigo ASC"; 
	$consulta_combo = $BD->Consultas($Consulta);
		}
		
	//Asignamos valores por cada consulta para comparaciones en combo
	switch($num)
	{
		case 18: 
				$cad1=trim($row3['cond_declarante']);
				break;
				
		case 19: 
				$cad1=trim($row3['esta_llenado']);
				break;
		
		case 21: 
				$cad1=trim($row4['supervisor']);
				break;
		case 22: 
				$cad1=trim($row4['tecnico']);
				break;
		case 23: 
				$cad1=trim($row4['verificador']);
				break;
		case 37: 
				$cad1=trim($row2['tipo_doc']);
				break;
				
		case 38: 
				$cad1=trim($row2['tipo_persona']);
				break;
				
		case 39: 
				$cad1=trim($row2['form_adquisicion']);
				break;
				
		case 40: 
				$cad1=trim($row2['condicion']);
				break;
	}
	
	// imprimo COMBOS
	if ($num==37 || $num==39 || $num==40)
	{
		echo "<select class='select' name='$name' id='$name' style='width:95px' disabled='true'>";
	}
	elseif ($num==38)
	{
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='javascript:cargar_tipo_persona(this.id)' >";
	}
	else
	{
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