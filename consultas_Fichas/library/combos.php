
<?php
function generaCombo($num)
{	
	//para el caso de los combbos clonados
	global $indice1;
	global $indice2;
	global $indice3;
	global $indice4;
	global $indice5;
	global $cad1;
	//para el caso de utilizar los arrays
	global $row1;
	global $row2;
	global $row3;
	global $row4_1;
	global $row4_2;
	global $row5;
	global $row7;
	global $row9;
	global $row10;
	global $row11;
	global $row11_1;
	global $row12;
	global $row13;
	global $row14;
	global $row15;
	global $row16;
	global $row17;
	global $row18;
	global $consulta_itc;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
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
				$ancho='width:700px';
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
				$iden='MFI';
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
		case 34:
				$iden='TDC';
				$name='d_tipo-'.$indice4;
				$ancho='width:350px';
				break;
		case 35:
				$iden='DOC';
				$name='ic_tipo-'.$indice5;
				$ancho='width:165px';
				break;
		case 36:
				$iden='CNP';
				$name='upc_cond-'.$indice1;
				
				break;		
		}
		
		if ($num==12){
			
				$Consulta="SELECT tf_usos.codi_uso AS codigo, tf_usos.codi_uso ||' - '||  tf_usos.desc_uso AS descri FROM tf_usos ORDER BY codi_uso ASC"; 
				$consulta_combo = $BD->Consultas($Consulta);
		}
			
		if ($num==14){
				$Consulta="SELECT tf_usos.codi_uso AS codigo, tf_usos.codi_uso ||' - '||  tf_usos.desc_uso AS descri FROM tf_usos ORDER BY codi_uso ASC"; 
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
		elseif ($num==26 || $num==27 || $num==28){
				$Consulta="SELECT codigo, codigo ||' - '|| desc_codigo AS descri FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden' ORDER BY codigo"; 
				$consulta_combo = $BD->Consultas($Consulta);
		}
		elseif ($num==30 || $num==31 || $num==32){
				$Consulta="SELECT codigo, codigo ||' - '|| desc_codigo AS descri FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden' ORDER BY codigo"; 
				$consulta_combo = $BD->Consultas($Consulta);
		}
		else{
		//relizamos consulta según las variables
				$Consulta="SELECT codigo, codigo ||' - '||  desc_codigo as descri FROM tf_tablas, tf_tablas_codigos WHERE tf_tablas.id_tabla = tf_tablas_codigos.id_tabla AND tf_tablas.id_tabla = '$iden' ORDER BY codigo"; 
				$consulta_combo = $BD->Consultas($Consulta);
		}
	
	//------------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------------
	// imprimo COMBOS

	
	if ($num==3)
	{	
		$cad1=trim($row5['tipo_persona']);
		if(trim($row5['tipo_persona'])=='1' or trim($row5['tipo_persona'])=='2')
			echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_tipo_persona(this.id)'>";
		else
			{
			echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_tipo_persona(this.id)'"; 
			echo "disabled='true'>";
			}
	}
	
	elseif ($num==4)
		{	$cad1=trim($row5['tipo_doc']);
			if(trim($row5['tipo_persona'])=='2' )
			{	
				$cad1='';
				echo "<select style='$ancho' class='select' name='$name' id='$name' disabled >";
				}
			else{
				echo "<select style='$ancho' class='select' name='$name' id='$name' >";
			}
		}
		
	
	elseif ($num==5)
	{
		$cad1=trim($row5['esta_civil']);
		if(trim($row5['tipo_persona'])=='1')
			echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_estado_civil(this.id)'>";
		else
			{
			echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_estado_civil(this.id)'"; 
			echo "disabled='true'>";
			}
	}
	
	elseif ($num==6)
	{	
		$cad1=trim($row5['tipo_persona_juridica']);
		if (trim($row5['tipo_persona'])=='1')
			{	
				echo "<select style='$ancho' class='select' name='$name' id='$name' disabled >";
				}
		else{
				echo "<select style='$ancho' class='select' name='$name' id='$name' >";
			}
		
	}
	
	elseif ($num==9)
	{
		$cad1=trim($row4_1['cond_titular']);
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_condicion_titular(this.id)'>";
	}
	elseif ($num==14)
	{
		$cad1=$row7['codi_uso'];
		echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_bloqueo_construccion(this.id)'>";
	}

	elseif ($num==24)
	{
		if($row5['esta_civil']=='02')//si es casado
			{	//ubicamos al cónyuge
				while($rowx=pg_fetch_array($consulta_itc)) 
					{ $cad1=trim($rowx['tipo_doc']); }
				echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_estado_civil(this.id)'>";
			}
		else 
			{
				echo "<select style='$ancho' class='select' name='$name' id='$name' onChange='cargar_estado_civil(this.id)'";
				echo " disabled>";
			}
		
	}
	elseif ($num==25)
	{
		/* Obtener el último carácter */
		$cad1=$row2['id_puerta'];
		$cad1=substr($cad1,strlen($cad1)-2,1);
		
		echo "<select class='select' name='$name' id='$name' style='width:110px'>";		
	}
	
	elseif ($num==26 || $num==27  || $num==28)
	{
		if($num==26) $cad1=trim($row9['mep']);
		
		if($num==27) $cad1=trim($row9['ecs']);
		
		if($num==28) $cad1=trim($row9['ecc']);
		
		echo "<select class='select' name='$name' id='$name' style='width:43px'>";
	}

	elseif ($num==30 || $num==31  || $num==32)
	{
		if($num==30) $cad1=trim($row10['mep']);
		
		if($num==31) $cad1=trim($row10['ecs']);
		
		if($num==32) $cad1=trim($row10['ecc']);
		
		echo "<select class='select' name='$name' id='$name' style='width:51px'>";
	}

	elseif ($num==36)
	{
		$cad1=$row2['cond_nume'];
				
		echo "<select class='select' name='$name' id='$name' style='width:95px'>";
	
	}
	
	else
	{
	
		if ($num==1)
		{	$cad1=$row3['tipo_edificacion'];
 			
			}
			
		if ($num==2)
		{	$cad1=$row3['tipo_interior'];
 			
			}
		
		if ($num==7)
		{	
			$cad1=trim($row5['condicion']);
		}
	
		if ($num==10)
		{
			$cad1=trim($row4_1['form_adquisicion']);
		}
		
		if ($num==11)
		{
			$cad1=trim($row4_2['condicion']);
		}
		
		if ($num==12)
		{
			$cad1=trim($row7['clasificacion']);
		}
		
		if ($num==13)
		{
			$cad1=trim($row7['cont_en']);
		}
		
		if ($num==15)
		{
			$cad1=trim($row11_1['id_notaria']);
		}
		
		if ($num==16)
		{
			$cad1=trim($row12['tipo_partida']);
		}
		
		if ($num==17)
		{
			$cad1=trim($row12['codi_decla_fabrica']);
		}
		
		if ($num==18)
		{
			$cad1=trim($row13['cond_declarante']);
		}
		
		if ($num==19)
		{
			$cad1=trim($row13['esta_llenado']);
		}
		
		if ($num==20)
		{
			$cad1=trim($row13['mantenimiento']);
		}
		
		if ($num==21 || $num==22  || $num==23)
		{
			if($num==21) $cad1=trim($row15['supervisor']);
			
			if($num==22) $cad1=trim($row15['tecnico']);
			
			if($num==23) $cad1=trim($row15['verificador']);
			
		}
		
		if ($num==29)
		{
			$cad1=trim($row9['uca']);
		}
		
		if ($num==33)
		{
			$cad1=trim($row10['uca']);
		}
		
		if ($num==34)
		{
			$cad1=trim($row11['tipo_doc']);
		}
		
		if ($num==35)
		{
			$cad1=trim($row14['tipo_doc']);
		}
		//COMBO INICIO	
		echo "<select style='$ancho' class='select' name='$name' id='$name'>";
	
	
	}
			
	//imprimo opciones y luego cierro
			echo "<option value='0'>SELECCIONE</option>";
			while($registro=pg_fetch_assoc($consulta_combo))
			{
				echo "<option value='".trim($registro['codigo'])."'";if(trim($registro['codigo'])==$cad1){echo " selected='true'";}echo ">".trim($registro['descri']).' -> Código:'.trim($registro['codigo']).'-> Comparado:'.$cad1.'<-'."</option>";
			}
		echo "</select>";
		//COMBO FIN
			
}//fin generaCombo



//---------------------------------------------------------------------
?>
