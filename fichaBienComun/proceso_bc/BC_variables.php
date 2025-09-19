<?php	
    $dg_dep=$_POST['dg_dep'];
	$dg_pro=$_POST['dg_pro'];
	$dg_dis=$_POST['dg_dis'];
	$ubigeo=$dg_dep.$dg_pro.$dg_dis;

	$con1=$_POST['contador1']; // VIAS
	$con2=$_POST['contador2']; // CONSTRUCCIONES
	$con3=$_POST['contador3']; // OBRAS
	$con4=$_POST['contador8']; // RECAP EDIFICIOS
	$con5=$_POST['contador9']; // RECAP BC
	
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 1ER DIV : VIAS
 	$nro_vias=0;
	for($i=0;$i<=$con1;$i++)
	{	
		$recibe0=$_POST['upc_cod-'.$i];
		$recibe1=$_POST['upc_tipo-'.$i];
		$recibe2=$_POST['upc_nom-'.$i];
		$recibe3=$_POST['upc_pue-'.$i];
		$recibe4=$_POST['upc_num-'.$i];
		$recibe5=$_POST['upc_cond-'.$i];
		$recibe6=$_POST['upc_certi-'.$i];
		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='')
		{	
			$upc_codvia[]=$recibe0;
			$upc_tipo[]=$recibe1;
			$upc_nom[]=$recibe2;
			$upc_codpue[]=trim($recibe3);
			$upc_num[]=$recibe4;
			$upc_cond[]=$recibe5;
			$upc_certi[]=$recibe6;
			$nro_vias++;
		}
	}
	//for($i=0;$i<=$nro_vias;$i++) echo $upc_codvia[$i]; echo '\n'; PRUEBA
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 2DO DIV : CONSTRUCCIONES
	$nro_cons=0;
 	for($i=0;$i<=$con2;$i++)
	{	
		$recibe0=$_POST['c_psm-'.$i];
			$new_date=str_replace("/","-",$_POST['c_fecha-'.$i]);
		$recibe1=date('d/M/Y', strtotime($new_date));
		
		$recibe2=trim($_POST['c_mep-'.$i]);
		$recibe3=trim($_POST['c_ecs-'.$i]);
		$recibe4=trim($_POST['c_ecc-'.$i]);
		$recibe5=strtoupper($_POST['c_myc-'.$i]);
		$recibe6=strtoupper($_POST['c_t-'.$i]);
		$recibe7=strtoupper($_POST['c_p-'.$i]);
		$recibe8=strtoupper($_POST['c_pyv-'.$i]);
		$recibe9=strtoupper($_POST['c_r-'.$i]);
		$recibe10=strtoupper($_POST['c_b-'.$i]);
		$recibe11=strtoupper($_POST['c_ies-'.$i]);
		if($_POST['c_d-'.$i]== NULL || $_POST['c_d-'.$i]=='')
			$recibe12=0.0;
		else $recibe12=$_POST['c_d-'.$i];
		if($_POST['c_v-'.$i]== NULL || $_POST['c_v-'.$i]=='')
			$recibe13=0.0;
		else $recibe13=$_POST['c_v-'.$i];
		$recibe14=trim($_POST['c_uca-'.$i]);
		
		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='')
		{
			$c_psm[]=$recibe0;
			$c_fecha[]=$recibe1;
			$c_mep[]=$recibe2;
			$c_ecs[]=$recibe3;
			$c_ecc[]=$recibe4;
			$c_myc[]=$recibe5;
			$c_t[]=$recibe6;
			$c_p[]=$recibe7;
			$c_pyv[]=$recibe8;
			$c_r[]=$recibe9;
			$c_b[]=$recibe10;
			$c_ies[]=$recibe11;
			$c_d[]=$recibe12;
			$c_v[]=$recibe13;
			$c_uca[]=$recibe14;
			$nro_cons++;
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "<pre>";
		print_r($c_psm);
        print_r($c_fecha);
        print_r($c_mep);
		print_r($c_ecs);
		print_r($c_ecc);
		print_r($c_myc);
		print_r($c_t);
		print_r($c_p);
		print_r($c_pyv);
		print_r($c_r);
		print_r($c_b);
		print_r($c_ies);
		print_r($c_d);
		print_r($c_v);
		print_r($c_uca);
	  echo "</pre>"; */
	  
	//------------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 3ER DIV: OBRAS
	$nro_obra=0;
 	for($i=0;$i<=$con3;$i++)
	{	
		$recibe0=trim($_POST['oc_cod-'.$i]);
		$recibe1=$_POST['oc_des-'.$i];
			$new_date=str_replace("/","-",$_POST['oc_fecha-'.$i]);
		$recibe2=date('d/M/Y', strtotime($new_date));
		
		$recibe3=trim($_POST['oc_mep-'.$i]);
		$recibe4=trim($_POST['oc_ecs-'.$i]);
		$recibe5=trim($_POST['oc_ecc-'.$i]);
		$recibe6=$_POST['oc_lar-'.$i];
		$recibe7=$_POST['oc_anc-'.$i];
		$recibe8=$_POST['oc_alt-'.$i];
		$recibe9=$_POST['oc_pro-'.$i];
		$recibe10=$_POST['oc_uni-'.$i];
		$recibe11=trim($_POST['oc_uca-'.$i]);
		
		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='')
		{
			$oc_cod[]=$recibe0;
			$oc_des[]=$recibe1;
			$oc_fecha[]=$recibe2;
			$oc_mep[]=$recibe3;
			$oc_ecs[]=$recibe4;
			$oc_ecc[]=$recibe5;
			$oc_lar[]=$recibe6;
			$oc_anc[]=$recibe7;
			$oc_alt[]=$recibe8;
			$oc_pro[]=$recibe9;
			$oc_uni[]=$recibe10;
			$oc_uca[]=$recibe11;
			$nro_obra++;		
		}
	}
	
	/*  echo "-----------------------------";	
		//IMPRESION DE MATRIZ
	  echo "<pre>";
		print_r($oc_cod);
        print_r($oc_des);
        print_r($oc_fecha);
		print_r($oc_mep);
		print_r($oc_ecs);
		print_r($oc_ecc);
		print_r($oc_lar);
		print_r($oc_anc);
		print_r($oc_alt);
		print_r($oc_pro);
		print_r($oc_uni);
		print_r($oc_uca);
	  echo "</pre>"; */
	
	//------------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 4TO DIV: RECAP EDIFICIOS
	$nro_edi=0;
 	for($i=0;$i<=$con4;$i++)
	{	
		$recibe0=trim($_POST['re_edi-'.$i]);
		
		if($_POST['re_por-'.$i]== NULL || $_POST['re_por-'.$i]=='')
			$recibe1=0.0;
		else $recibe1=$_POST['re_por-'.$i];
		
		if($_POST['re_atc-'.$i]== NULL || $_POST['re_atc-'.$i]=='')
			$recibe2=0.0;
		else $recibe2=$_POST['re_atc-'.$i];
		
		if($_POST['re_acc-'.$i]== NULL || $_POST['re_acc-'.$i]=='')
			$recibe3=0.0;
		else $recibe3=$_POST['re_acc-'.$i];
		
		if($_POST['re_aoic-'.$i]== NULL || $_POST['re_aoic-'.$i]=='')
			$recibe4=0.0;
		else $recibe4=$_POST['re_aoic-'.$i];
		
	
		
				
		//QUE NO PASEN LOS VACIOS
		if (($recibe0=='null') || ($recibe0!='0'))
		{
			$re_edi[]=$recibe0;
			$re_por[]=$recibe1;
			$re_atc[]=$recibe2;
			$re_acc[]=$recibe3;
			$re_aoic[]=$recibe4;
			$nro_edi++;
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "-----------------------------";
	  echo "<pre>";
		print_r($re_edi);
        print_r($re_por);
        print_r($re_atc);
		print_r($re_acc);
		print_r($re_aoic);
	  echo "</pre>"; */
	  

	//------------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 5TO DIV: RECAP BC
	$nro_bc=0;
 	for($i=0;$i<=$con5;$i++)
	{	
		$recibe0=$_POST['rbc_numero-'.$i];
		$recibe1=$_POST['rbc_edifica-'.$i];
		$recibe2=$_POST['rbc_entrada-'.$i];
		$recibe3=$_POST['rbc_piso-'.$i];
		$recibe4=$_POST['rbc_unidad-'.$i];
		$recibe5=$_POST['rbc_porcentaje-'.$i];
		$recibe6=$_POST['rbc_atc-'.$i];
		$recibe7=$_POST['rbc_acc-'.$i];
		$recibe8=$_POST['rbc_aoic-'.$i];
		
		//QUE NO PASEN LOS VACIOS
		if (($recibe0!='null') || ($recibe0!=''))
		{	
				$rbc_numero[]=$recibe0;
				$rbc_edifica[]=$recibe1;
				$rbc_entrada[]=$recibe2;
				$rbc_piso[]=$recibe3;
				$rbc_unidad[]=$recibe4;
				$rbc_porcentaje[]=$recibe5;
				$rbc_atc[]=$recibe6;
				$rbc_acc[]=$recibe7;
				$rbc_aoic[]=$recibe8;
				$nro_bc++;
			
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "-------------------------------------";
	  echo "<pre>";
		print_r($rbc_numero);
        print_r($rbc_edifica);
        print_r($rbc_entrada);
		print_r($rbc_piso);
		print_r($rbc_unidad);
		print_r($rbc_porcentaje);
		print_r($rbc_atc);
		print_r($rbc_acc);
		print_r($rbc_aoic);
	  echo "</pre>";*/ 
		
	//****************************************** VARIABLES LIBRES FORMULARIO *********************
	$numficha=$_POST['numficha'];
	$numflote1=$_POST['numflote1'];   
	$numflote2=$_POST['numflote2'];
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ dg	
	$dg_cuc8=$_POST['dg_cuc8'];
	$dg_cuc4=$_POST['dg_cuc4'];   
	$dg_hojacatastral=$_POST['dg_hojacatastral'];
	$dg_sector=$_POST['dg_sector'];
	$dg_manzana=$_POST['dg_manzana'];   
	$dg_lote=$_POST['dg_lote'];
	$dg_edificacion=$_POST['dg_edificacion'];
	$dg_entrada=$_POST['dg_entrada'];   
	$dg_piso=$_POST['dg_piso'];
	$dg_unidad=$_POST['dg_unidad'];
	$dg_dc=$_POST['dg_dc'];   
	$dg_codcontribuyente=$_POST['dg_codcontribuyente'];
	$dg_codpredial=$_POST['dg_codpredial'];
	$dg_unicodpredial=$_POST['dg_unicodpredial'];   
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ upc
	$upc_cmb_tipoedi=trim($_POST['upc_cmb_tipoedi']);
	$upc_cmb_tipoint=trim($_POST['upc_cmb_tipoint']);
	$upc_nomedi=$_POST['upc_nomedi'];   
	$upc_numint=$_POST['upc_numint'];
	$upc_codhu=$_POST['upc_codhu'];
	$upc_nomhu=$_POST['upc_nomhu'];   
	$upc_zse=$_POST['upc_zse'];
	$upc_mzna=$_POST['upc_mzna']; 
	$upc_lote=$_POST['upc_lote'];  
	$upc_sublote=$_POST['upc_sublote']; 

	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ dp
	$dp_cmb_claspre=trim($_POST['dp_cmb_claspre']);
	$dp_cmb_precat=trim($_POST['dp_cmb_precat']);
	$dp_cmb_usoprecat=trim($_POST['dp_cmb_usoprecat']);
	$dp_estructura=$_POST['dp_estructura'];
	$dp_zonifica=$_POST['dp_zonifica'];
	
	if($_POST['dp_areattitulo']==NULL || $_POST['dp_areattitulo']=='') 
		$dp_areattitulo=0.0;
	else $dp_areattitulo=$_POST['dp_areattitulo'];
	
	if($_POST['dp_areatverifica']==NULL || $_POST['dp_areatverifica']=='') 
		$dp_areatverifica=0.0;
	else $dp_areatverifica=$_POST['dp_areatverifica'];
	
	$dp_medcam_fre=$_POST['dp_medcam_fre'];
	$dp_medsegtitu_fre=$_POST['dp_medsegtitu_fre'];
	$dp_colcam_fre=$_POST['dp_colcam_fre'];
	$dp_colsegtitu_fre=$_POST['dp_colsegtitu_fre'];
	$dp_medcam_der=$_POST['dp_medcam_der'];
	$dp_medsegtitu_der=$_POST['dp_medsegtitu_der'];
	$dp_colcam_der=$_POST['dp_colcam_der'];
	$dp_colsegtitu_der=$_POST['dp_colsegtitu_der'];
	$dp_medcam_izq=$_POST['dp_medcam_izq'];
	$dp_medsegtitu_izq=$_POST['dp_medsegtitu_izq'];
	$dp_colcam_izq=$_POST['dp_colcam_izq'];
	$dp_colsegtitu_izq=$_POST['dp_colsegtitu_izq'];
	$dp_medcam_fon=$_POST['dp_medcam_fon'];
	$dp_medsegtitu_fon=$_POST['dp_medsegtitu_fon'];
	$dp_colcam_fon=$_POST['dp_colcam_fon'];
	$dp_colsegtitu_fon=$_POST['dp_colsegtitu_fon'];
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ sb
	$sb_luz=$_POST['sb_luz'];
		if($sb_luz!=1) 			$sb_luz=2;
	$sb_numsumluz=$_POST['sb_numsumluz'];
	$sb_agua=$_POST['sb_agua'];
		if($sb_agua!=1)		 	$sb_agua=2;
	$sb_numconagua=$_POST['sb_numconagua'];
	$sb_telefono=$_POST['sb_telefono'];
			if($sb_telefono!=1) $sb_telefono=2;
	$sb_numtelf=$_POST['sb_numtelf'];
	$sb_desague=$_POST['sb_desague'];
			if($sb_desague!=1) 	$sb_desague=2;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ d
	$valor=trim($_POST['d_cmb_nomnot']);
	if($valor==NULL || $valor=='' || $valor=='0')
		$d_cmb_nomnot='0'; //por defecto Notaria sin declarar
	else $d_cmb_nomnot=trim($_POST['d_cmb_nomnot']); 
	
	$d_kardex=$_POST['d_kardex']; 
		$new_date=str_replace("/","-",$_POST['d_fechaescpub']);
	$d_fechaescpub=date('d/M/Y', strtotime($new_date));
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ipcrp	
	$ipcrp_cmb_tipoparreg=trim($_POST['ipcrp_cmb_tipoparreg']); 
	$ipcrp_numpar=$_POST['irp_numpar']; 
	$ipcrp_fojas=$_POST['irp_fojas']; 
	$ipcrp_asiento=$_POST['irp_asiento']; 
		$new_date=str_replace("/","-",$_POST['irp_fechains']);
	$ipcrp_fechains =date('d/M/Y', strtotime($new_date));
	$ipcrp_cmb_decfab=trim($_POST['ipcrp_cmb_decfab']); 
	$ipcrp_asinfab=$_POST['irp_asinfab']; 
		$new_date=str_replace("/","-",$_POST['irp_fechinsfab']);
	$ipcrp_fechinsfab=date('d/M/Y', strtotime($new_date));
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ epc	
	$epc_opt_evalua=$_POST['opt_evalua'];
	
	if($_POST['re_lotcol']==NULL || $_POST['re_lotcol']=='') 
		$re_lotcol=0.0;
	else $re_lotcol=$_POST['re_lotcol']; 
	
	if($_POST['re_areapub']==NULL || $_POST['re_areapub']=='') 
		$re_areapub=0.0;
	else $re_areapub=$_POST['re_areapub']; 
	
	if($_POST['re_jarais']==NULL || $_POST['re_jarais']=='') 
		$re_jarais=0.0;
	else $re_jarais=$_POST['re_jarais']; 
	
	if($_POST['re_areaint']==NULL || $_POST['re_areaint']=='') 
		$re_areaint=0.0;
	else $re_areaint=$_POST['re_areaint']; 
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ic
	$ic_cmb_conddec=trim($_POST['ic_cmb_conddec']); 
	$ic_cmb_estficha=trim($_POST['ic_cmb_estficha']);
	
	$ic_cmb_man=trim($_POST['ic_cmb_man']);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ observa
	$observacion=trim($_POST['observacion']);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ f
	$f_dni=$_POST['f_dni'];
	$f_nom=$_POST['f_nom'];
	$f_paterno=$_POST['f_paterno'];
	$f_materno=$_POST['f_materno'];
			$new_date=str_replace("/","-",$_POST['f_fecha']);
	$f_fecha =date('d/M/Y', strtotime($new_date));
	$f_cmb_sup=$_POST['f_cmb_sup'];
		$new_date=str_replace("/","-",$_POST['f_fechasup']);
	$f_fechasup=date('d/M/Y', strtotime($new_date));
	$f_cmb_tec=$_POST['f_cmb_tec'];
		$new_date=str_replace("/","-",$_POST['f_fechatec']);
	$f_fechatec=date('d/M/Y', strtotime($new_date));
	$f_cmb_ver=$_POST['f_cmb_ver'];
		$new_date=str_replace("/","-",$_POST['f_fechaver']);
	$f_fechaver=date('d/M/Y', strtotime($new_date));
	$f_numreg=$_POST['f_numreg'];
	
	$f_fecha_grabado=date('d/m/Y\TH:i:s',time() - 3600);
	

//************************************************
		
?>