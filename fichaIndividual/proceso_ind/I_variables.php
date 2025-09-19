<?php	
	error_reporting(E_ALL ^ E_NOTICE);
	
    $dg_dep=$_POST['dg_dep'];
	$dg_pro=$_POST['dg_pro'];
	$dg_dis=$_POST['dg_dis'];
	$ubigeo=$dg_dep.$dg_pro.$dg_dis;

	$con1=$_POST['contador1']; // VIAS
	$con2=$_POST['contador2']; // CONSTRUCCIONES
	$con3=$_POST['contador3']; // OBRAS
	$con4=$_POST['contador4']; // DOCUMENTOS
	$con5=$_POST['contador5']; // LITIGANTES
	
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 1ER DIV : VIAS
 	$nro_vias=0;
	for($i=0;$i<=$con1;$i++)
	{	
		$recibe0= (isset($_POST['upc_cod-'.$i]))? $_POST['upc_cod-'.$i]:'';
		$recibe1= (isset($_POST['upc_tipo-'.$i]))? $_POST['upc_tipo-'.$i]:'';
		$recibe2= (isset($_POST['upc_nom-'.$i]))? $_POST['upc_nom-'.$i]:'';
		$recibe3= (isset($_POST['upc_pue-'.$i]))? $_POST['upc_pue-'.$i]:'';
		$recibe4= (isset($_POST['upc_num-'.$i]))? $_POST['upc_num-'.$i]:'';
		$recibe5= (isset($_POST['upc_cond-'.$i]))? $_POST['upc_cond-'.$i]:'';
		$recibe6= (isset($_POST['upc_certi-'.$i]))? $_POST['upc_certi-'.$i]:'';

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
	
	/*for($i=0;$i<=$nro_vias;$i++)
	{ 	
			echo $upc_codvia[$i]; //echo '\n'; //PRUEBA
			echo $upc_tipo[$i];
			echo $upc_nom[$i];
			echo $upc_codpue[$i];
			echo $upc_num[$i];
			echo $upc_cond[$i];
			echo $upc_certi[$i];	
	}*/
	
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 2DO DIV : CONSTRUCCIONES
	$nro_cons=0;
 	for($i=0;$i<=$con2;$i++)
	{	
		$recibe0=$_POST['c_psm-'.$i];
			$new_date=str_replace("/","-",$_POST['c_fecha-'.$i]);
		$recibe1=date('d/M/Y', strtotime($new_date));
		//$recibe1=$_POST['c_fecha-'.$i];
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
		//$recibe2=$_POST['oc_fecha-'.$i];
		$recibe3=trim($_POST['oc_mep-'.$i]);
		$recibe4=trim($_POST['oc_ecs-'.$i]);
		$recibe5=trim($_POST['oc_ecc-'.$i]);

		// $recibe6=$_POST['oc_lar-'.$i];
		($_POST['oc_lar-'.$i]== NULL || $_POST['oc_lar-'.$i]=='')? $recibe6=0.0 : $recibe6=$_POST['oc_lar-'.$i];

		// $recibe7=$_POST['oc_anc-'.$i];
		($_POST['oc_anc-'.$i]== NULL || $_POST['oc_anc-'.$i]=='')? $recibe7=0.0 : $recibe7=$_POST['oc_anc-'.$i];

		// $recibe8=$_POST['oc_alt-'.$i];
		($_POST['oc_alt-'.$i]== NULL || $_POST['oc_alt-'.$i]=='')? $recibe8=0.0 : $recibe8=$_POST['oc_alt-'.$i];

		// $recibe9=$_POST['oc_pro-'.$i];
		($_POST['oc_pro-'.$i]== NULL || $_POST['oc_pro-'.$i]=='')? $recibe9=0.0 : $recibe9=$_POST['oc_pro-'.$i];
		
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

		// $oc_lar[$i],$oc_anc[$i],$oc_alt[$i],$oc_pro[$i]

		/*
		// VEAMOSSSSSSSSSSSSSSSSSS
	  	echo "-----------------------------";	
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
	  	echo "</pre>";  */
	}
	
	//------------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 4TO DIV: DOCUMENTOS
	$nro_docu=0;
 	for($i=0;$i<=$con4;$i++)
	{	
		$recibe0=trim($_POST['d_tipo-'.$i]);
		$recibe1=$_POST['d_nro-'.$i];
			$new_date=str_replace("/","-",$_POST['d_fecha-'.$i]);
		$recibe2=date('d/M/Y', strtotime($new_date));
		//$recibe2=$_POST['d_fecha-'.$i];
		
		if($_POST['d_area-'.$i]== NULL || $_POST['d_area-'.$i]=='')
			$recibe3=0.0;
		else $recibe3=$_POST['d_area-'.$i];

		//QUE NO PASEN LOS VACIOS
		if (($recibe0=='null') || ($recibe0!='0'))
		{
			$d_tipo[]=$recibe0;
			$d_nro[]=$recibe1;
			$d_fecha[]=$recibe2;
			$d_area[]=$recibe3;
			$nro_docu++;
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "-----------------------------";
	  echo "<pre>";
		print_r($d_tipo);
        print_r($d_nro);
        print_r($d_fecha);
		print_r($d_area);
	  echo "</pre>"; */

	//------------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 5TO DIV: LITIGANTES
	$nro_liti=0;
 	for($i=0;$i<=$con5;$i++)
	{	
		$recibe0=trim($_POST['ic_tipo-'.$i]);
		$recibe1=$_POST['ic_nro-'.$i];
		$recibe2=$_POST['ic_liti-'.$i];
		$recibe3=$_POST['ic_cod-'.$i];
		
		//QUE NO PASEN LOS VACIOS
		if (($recibe0!='null') || ($recibe0!=''))
		{	if(strlen($recibe0)>1)
			{
				$ic_tipo[]=$recibe0;
				$ic_nro[]=$recibe1;
				$ic_liti[]=$recibe2;
				$ic_cod[]=$recibe3;
				$nro_liti++;
			}
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "-------------------------------------";
	  echo "<pre>";
		print_r($ic_tipo);
        print_r($ic_nro);
        print_r($ic_liti);
		print_r($ic_cod);
	  echo "</pre>"; */
		
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
	
	// --------->>> VARIABLE NO EXISTE
	//$dg_unicodpredial=$_POST['dg_unicodpredial'];
	(isset($_POST['dg_unicodpredial']))? $dg_unicodpredial=$_POST['dg_unicodpredial'] : $dg_unicodpredial="";
	//ECHO "dg_unicodpredial".$dg_unicodpredial."<br>";
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ upc
	$upc_cmb_tipoedi= (isset($_POST['upc_cmb_tipoedi']))? trim($_POST['upc_cmb_tipoedi']):'';
	$upc_cmb_tipoint= (isset($_POST['upc_cmb_tipoint']))? trim($_POST['upc_cmb_tipoint']):'';
	$upc_nomedi= (isset($_POST['upc_nomedi']))? $_POST['upc_nomedi']:'';   
	$upc_numint= (isset($_POST['upc_numint']))? $_POST['upc_numint']:'';
	$upc_codhu= (isset($_POST['upc_codhu']))? $_POST['upc_codhu']:'';
	$upc_nomhu= (isset($_POST['upc_nomhu']))? $_POST['upc_nomhu']:'';   
	$upc_zse= (isset($_POST['upc_zse']))? $_POST['upc_zse']:'';
	$upc_mzna= (isset($_POST['upc_mzna']))? $_POST['upc_mzna']:''; 
	$upc_lote= (isset($_POST['upc_lote']))? $_POST['upc_lote']:'';  
	$upc_sublote= (isset($_POST['upc_sublote']))? $_POST['upc_sublote']:''; 
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ itc	
	// --->>> VARIABLE EN REVISION
	//$itc_cmb_tipodoc1=trim($_POST['itc_cmb_tipodoc1'])
	(isset($_POST['itc_cmb_tipotitu']))? $itc_cmb_tipotitu=trim($_POST['itc_cmb_tipotitu']) : $itc_cmb_tipotitu="";
	//ECHO "itc_cmb_tipotitu: ".$itc_cmb_tipotitu."<br><br>";

	// --->>> VARIABLE EN REVISION
	//$itc_cmb_tipodoc1=trim($_POST['itc_cmb_tipodoc1'])
	(isset($_POST['itc_cmb_tipodoc1']))? $itc_cmb_tipodoc1=trim($_POST['itc_cmb_tipodoc1']) : $itc_cmb_tipodoc1="";
	//ECHO "itc_cmb_tipodoc1: ".$itc_cmb_tipodoc1."<br>";	
	
	//$itc_cmb_ecivil=trim($_POST['itc_cmb_ecivil']);
	(isset($_POST['itc_cmb_ecivil']))? $itc_cmb_ecivil=trim($_POST['itc_cmb_ecivil']) : $itc_cmb_ecivil="";

	// --->>> VARIABLE EN REVISION
	//$itc_numdoc1=$_POST['itc_numdoc1'];
	(isset($_POST['itc_numdoc1']))? $itc_numdoc1=$_POST['itc_numdoc1'] : $itc_numdoc1="";
	//ECHO "itc_numdoc1: ".$itc_numdoc1."<br>";

	// --->>> VARIABLE EN REVISION
	// $itc_nombre1=$_POST['itc_nombre1']
	(isset($_POST['itc_nombre1']))? $itc_nombre1=$_POST['itc_nombre1'] : $itc_nombre1="";
	//ECHO "itc_nombre1: ".$itc_nombre1."<br>";
	
	// --->>> VARIABLE EN REVISION
	// $itc_paterno1=$_POST['itc_paterno1']
	(isset($_POST['itc_paterno1']))? $itc_paterno1=$_POST['itc_paterno1'] : $itc_paterno1="";
	//ECHO "itc_paterno1: ".$itc_paterno1."<br>";
	
	// --->>> VARIABLE EN REVISION
	// $itc_materno1=$_POST['itc_materno1'];
	(isset($_POST['itc_materno1']))? $itc_materno1=$_POST['itc_materno1'] : $itc_materno1="";
	//ECHO "itc_materno1: ".$itc_materno1."<br><br>";


	// --->>> VARIABLE EN REVISION
	//$itc_cmb_tipodoc2=trim($_POST['itc_cmb_tipodoc2']);
	(isset($_POST['itc_cmb_tipodoc2']))? $itc_cmb_tipodoc2=trim($_POST['itc_cmb_tipodoc2']) : $itc_cmb_tipodoc2="";
	//ECHO "itc_cmb_tipodoc2: ".$itc_cmb_tipodoc2."<br>";

	// --->>> VARIABLE EN REVISION
	//$itc_numdoc2=$_POST['itc_numdoc2'];
	(isset($_POST['itc_numdoc2']))? $itc_numdoc2=$_POST['itc_numdoc2'] : $itc_numdoc2="";
	//ECHO "itc_numdoc2: ".$itc_numdoc2."<br>";

	// --->>> VARIABLE EN REVISION
	//$itc_nombre2=$_POST['itc_nombre2'];
	(isset($_POST['itc_nombre2']))? $itc_nombre2=$_POST['itc_nombre2'] : $itc_nombre2="";
	//ECHO "itc_nombre2: ".$itc_nombre2."<br>";

	// --->>> VARIABLE EN REVISION
	//$itc_paterno2=$_POST['itc_paterno2'];
	(isset($_POST['itc_paterno2']))? $itc_paterno2=$_POST['itc_paterno2'] : $itc_paterno2="";
	//ECHO "itc_paterno2: ".$itc_paterno2."<br>";
	
	// --->>> VARIABLE EN REVISION
	// $itc_materno2=$_POST['itc_materno2'];
	(isset($_POST['itc_materno2']))? $itc_materno2=$_POST['itc_materno2'] : $itc_materno2="";
	//ECHO "itc_materno2: ".$itc_materno2."<br>";


	// --->>> VARIABLE EN REVISION
	// $itc_cmb_perjur=trim($_POST['itc_cmb_perjur']);
	(isset($_POST['itc_cmb_perjur']))? $itc_cmb_perjur=trim($_POST['itc_cmb_perjur']) : $itc_cmb_perjur="";
	//ECHO "itc_cmb_perjur: ".$itc_cmb_perjur."<br>";

	// --->>> VARIABLE EN REVISION
	// $itc_ruc=$_POST['itc_ruc'];
	(isset($_POST['itc_ruc']))? $itc_ruc=$_POST['itc_ruc'] : $itc_ruc="";
	//ECHO "itc_ruc: ".$itc_ruc."<br>";
	
	// --->>> VARIABLE EN REVISION
	// $itc_razsocial=$_POST['itc_razsocial'];
	(isset($_POST['itc_razsocial']))? $itc_razsocial=$_POST['itc_razsocial'] : $itc_razsocial="";
	//ECHO "itc_razsocial: ".$itc_razsocial."<br>";

	// <!-- VARIABLES EXONERACION DE TITULAR -->

	// --->>> VARIABLE EN REVISION
	// $itc_cmb_condesptitu=trim($_POST['itc_cmb_condesptitu']);
	(isset($_POST['itc_cmb_condesptitu']))? $itc_cmb_condesptitu=trim($_POST['itc_cmb_condesptitu']) : $itc_cmb_condesptitu="";
	//ECHO "itc_cmb_condesptitu: ".$itc_cmb_condesptitu."<br>";

	(isset($_POST['itc_numresexo']))? $itc_numresexo=$_POST['itc_numresexo'] : $itc_numresexo="";
	//$itc_numresexo=$_POST['itc_numresexo'];

	$itc_numbolpen= (isset($_POST['itc_numbolpen']))? $_POST['itc_numbolpen']:'';
		
	$new_date=str_replace("/","-",$_POST['itc_fechainiexo']);
	$itc_fechainiexo=date('d/M/Y', strtotime($new_date));
		
	$new_date=str_replace("/","-",$_POST['itc_fechafinexo']);
	$itc_fechafinexo=date('d/M/Y', strtotime($new_date));
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ dftc	
	$departamentos=$_POST['departamentos'];
	$provincias=$_POST['provincias'];
	$distritos=$_POST['distritos'];
	
	//para caso de edicion de combo en individual
	//Si el valor es menor al contador (02 CARACTERES)
	if(strlen($departamentos)<2)
	{	/*echo "<script>alert('NO CAMBIÓ EL UBIGEO');</script>\n";*/
		$departamentos=$_POST['departamento'];
		$provincias=$_POST['provincia'];
		$distritos=$_POST['distrito'];
	}
	
	//echo $departamentos.' '.$provincias.' '.$distritos;
	$dftc_telf=$_POST['dftc_telf'];
	$dftc_anexo=$_POST['dftc_anexo'];
	$dftc_fax=$_POST['dftc_fax'];
	$dftc_email=$_POST['dftc_email'];
	$dftc_codvia=$_POST['dftc_codvia'];
	$dftc_tipovia=$_POST['dftc_tipovia'];
	$dftc_nomvia=$_POST['dftc_nomvia'];
	$dftc_nummuni=$_POST['dftc_nummuni'];
	$dftc_nomedi=$_POST['dftc_nomedi'];
	$dftc_numint=$_POST['dftc_numint'];
	$dftc_codhu=$_POST['dftc_codhu'];
	$dftc_nomhu=$_POST['dftc_nomhu'];
	$dftc_zse=$_POST['dftc_zse'];
	$dftc_mzna=$_POST['dftc_mzna'];
	$dftc_lote=$_POST['dftc_lote'];
	$dftc_sublote=$_POST['dftc_sublote'];
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ct
	$ct_cmb_condtitu=trim($_POST['ct_cmb_condtitu']);
	$ct_cmb_formadq=trim($_POST['ct_cmb_formadq']);
		$new_date=str_replace("/","-",$_POST['ct_fechaadq']);
	$ct_fechaadq =date('d/M/Y', strtotime($new_date));
	$ct_cmb_condesppre= (isset($_POST['ct_cmb_condesppre']))? trim($_POST['ct_cmb_condesppre']):'';
	$ct_numresexo= (isset($_POST['ct_numresexo']))? $_POST['ct_numresexo']:'';
	
	if($_POST['ct_porcentaje']==NULL || $_POST['ct_porcentaje']=='') 
		$ct_porcentaje=0.0;
	else $ct_porcentaje=$_POST['ct_porcentaje'];

		$new_date=str_replace("/","-",$_POST['ct_fechaini']);
	$ct_fechaini =date('d/M/Y', strtotime($new_date));
	
		$new_date=str_replace("/","-",$_POST['ct_fechafin']);
	$ct_fechafin =date('d/M/Y', strtotime($new_date));
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ dp
	$dp_cmb_claspre= (isset($_POST['dp_cmb_claspre']))? trim($_POST['dp_cmb_claspre']):'';
	$dp_cmb_precat= (isset($_POST['dp_cmb_precat']))? trim($_POST['dp_cmb_precat']):'';
	$dp_cmb_usoprecat= (isset($_POST['dp_cmb_usoprecat']))? trim($_POST['dp_cmb_usoprecat']):'';
	$dp_estructura= (isset($_POST['dp_estructura']))? $_POST['dp_estructura']:'';
	$dp_zonifica= (isset($_POST['dp_zonifica']))? $_POST['dp_zonifica']:'';
	
	if($_POST['dp_areatitulo']==NULL || $_POST['dp_areatitulo']=='') 
		$dp_areatitulo=0.0;
	else $dp_areatitulo=$_POST['dp_areatitulo'];
	
	if($_POST['dp_areadeclara']==NULL || $_POST['dp_areadeclara']=='') 
		$dp_areadeclara=0.0;
	else $dp_areadeclara=$_POST['dp_areadeclara'];
	
	if($_POST['dp_areaverifica']==NULL || $_POST['dp_areaverifica']=='') 
		$dp_areaverifica=0.0;
	else $dp_areaverifica=$_POST['dp_areaverifica'];
	
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
	$sb_luz = (isset($_POST['sb_luz']))? $_POST['sb_luz']:0;
	if($sb_luz!=1) 		$sb_luz=2;

	$sb_numsumluz = (isset($_POST['sb_numsumluz']))? $_POST['sb_numsumluz']:0;

	$sb_agua = (isset($_POST['sb_agua']))? $_POST['sb_agua']:0;
	if($sb_agua!=1)		 $sb_agua=2;

	$sb_numconagua = (isset($_POST['sb_numconagua']))? $_POST['sb_numconagua']:0;

	$sb_telefono = (isset($_POST['sb_telefono']))? $_POST['sb_telefono']:0;
	if($sb_telefono!=1)	 $sb_telefono=2;

	$sb_numtelf = (isset($_POST['sb_numtelf']))? $_POST['sb_numtelf']:0;

	$sb_desague = (isset($_POST['sb_desague']))? $_POST['sb_desague']:0;
	if($sb_desague!=1) 	 $sb_desague=2;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ c	
	if($_POST['c_terreleg']==NULL || $_POST['c_terreleg']=='') 
		$c_terreleg=0.0;
	else $c_terreleg=$_POST['c_terreleg']; 
	
	if($_POST['c_terrfis']==NULL || $_POST['c_terrfis']=='') 
		$c_terrfis=0.0;
	else $c_terrfis=$_POST['c_terrfis']; 
	
	if($_POST['c_consleg']==NULL || $_POST['c_consleg']=='') 
		$c_consleg=0.0;
	else $c_consleg=$_POST['c_consleg']; 
	
	if($_POST['c_consfis']==NULL || $_POST['c_consfis']=='') 
		$c_consfis=0.0;
	else $c_consfis=$_POST['c_consfis']; 
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
	$ipcrp_numpar=$_POST['ipcrp_numpar']; 
	$ipcrp_fojas=$_POST['ipcrp_fojas']; 
	$ipcrp_asiento=$_POST['ipcrp_asiento']; 
		$new_date=str_replace("/","-",$_POST['ipcrp_fechains']);
	$ipcrp_fechains =date('d/M/Y', strtotime($new_date));
	$ipcrp_cmb_decfab=trim($_POST['ipcrp_cmb_decfab']); 
	$ipcrp_asinfab=$_POST['ipcrp_asinfab']; 
		$new_date=str_replace("/","-",$_POST['ipcrp_fechinsfab']);
	$ipcrp_fechinsfab=date('d/M/Y', strtotime($new_date));
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ epc	
	$epc_opt_evalua=$_POST['opt_evalua'];
	
	if($_POST['epc_lotcol']==NULL || $_POST['epc_lotcol']=='') 
		$epc_lotcol=0.0;
	else $epc_lotcol=$_POST['epc_lotcol']; 
	
	if($_POST['epc_areapub']==NULL || $_POST['epc_areapub']=='') 
		$epc_areapub=0.0;
	else $epc_areapub=$_POST['epc_areapub']; 
	
	if($_POST['epc_jarais']==NULL || $_POST['epc_jarais']=='') 
		$epc_jarais=0.0;
	else $epc_jarais=$_POST['epc_jarais']; 
	
	if($_POST['epc_areaint']==NULL || $_POST['epc_areaint']=='') 
		$epc_areaint=0.0;
	else $epc_areaint=$_POST['epc_areaint']; 
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ic
	$ic_cmb_conddec=trim($_POST['ic_cmb_conddec']); 
	$ic_cmb_estficha=trim($_POST['ic_cmb_estficha']);
	
	if($_POST['ic_numhab']==NULL || $_POST['ic_numhab']=='') 
		$ic_numhab=0;
	else $ic_numhab=$_POST['ic_numhab'];
	
	if($valor=$_POST['ic_numfam']==NULL || $valor=$_POST['ic_numfam']=='') 
		$ic_numfam=0;
	else $ic_numfam=$_POST['ic_numfam'];
	
	$ic_cmb_man=trim($_POST['ic_cmb_man']);
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ observa
	$observacion= (isset($_POST['observacion']))? trim($_POST['observacion']):'';
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
	//$f_fecha_grabado=date('d/m/Y');
	$f_fecha_grabado=date('d/m/Y\TH:i:s',time() - 3600);
	
//***********************************************
//NUEVAS SESIONES PARA OTRAS FICHAS

	$_SESSION['cuc8']=$dg_cuc8;
	$_SESSION['cuc4']=$dg_cuc4;
	$_SESSION['sector']=$dg_sector;
	$_SESSION['manzana']=$dg_manzana;
	$_SESSION['lote']=$dg_lote;
	$_SESSION['edifica']=$dg_edificacion;
	$_SESSION['entrada']=$dg_entrada;
	$_SESSION['piso']=$dg_piso;
	$_SESSION['unidad']=$dg_unidad;
	$_SESSION['hojacatastral']=$dg_hojacatastral;
	
	$_SESSION['ic_condicion']=$ic_cmb_conddec;
	$_SESSION['ic_estado']=$ic_cmb_estficha;
	$_SESSION['dc']=$dg_dc;
	
	//-------------------------
	$_SESSION['itc_cmb_tipotitu']=$itc_cmb_tipotitu;
	
	$_SESSION['itc_cmb_tipodoc']=$itc_cmb_tipodoc1;	
	$_SESSION['itc_numdoc']=$itc_numdoc1;
	$_SESSION['itc_nombre']=$itc_nombre1;
	$_SESSION['itc_paterno']=$itc_paterno1;
	$_SESSION['itc_materno']=$itc_materno1;

	$_SESSION['itc_ruc']=$itc_ruc;
	$_SESSION['itc_razsocial']=$itc_razsocial;
	
	$_SESSION['departamentos']=$departamentos;
	$_SESSION['provincias']=$provincias;
	$_SESSION['istritos']=$distritos;
	$_SESSION['dftc_telf']=$dftc_telf;
	$_SESSION['dftc_anexo']=$dftc_anexo;
	$_SESSION['dftc_fax']=$dftc_fax;
	$_SESSION['dftc_email']=$dftc_email;
	$_SESSION['dftc_codvia']=$dftc_codvia;
	$_SESSION['dftc_tipovia']=$dftc_tipovia;
	$_SESSION['dftc_nomvia']=$dftc_nomvia;
	$_SESSION['dftc_nummuni']=$dftc_nummuni;
	$_SESSION['dftc_nomedi']=$dftc_nomedi;
	$_SESSION['ftc_numint']=$dftc_numint;
	$_SESSION['dftc_codhu']=$dftc_codhu;
	$_SESSION['dftc_nomhu']=$dftc_nomhu;
	$_SESSION['dftc_zse']=$dftc_zse;
	$_SESSION['dftc_mzna']=$dftc_mzna;
	$_SESSION['dftc_lote']=$dftc_lote;
	$_SESSION['dftc_sublote']=$dftc_sublote;		
?>