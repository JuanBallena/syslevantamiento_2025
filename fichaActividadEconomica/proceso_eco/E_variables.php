<?php	
    $dg_dep=$_POST['dg_dep'];
	$dg_pro=$_POST['dg_pro'];
	$dg_dis=$_POST['dg_dis'];
	$ubigeo=$dg_dep.$dg_pro.$dg_dis;

	$con1=$_POST['contador1']; // ACTIVIDAD
	$con2=$_POST['contador2']; // AUTOTIRACION ANUNCIOS
	
	$tipo_conductor=$_POST['conductor']; // TIPO DE CONDUCTOR, para el grabado de persona
	
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 1ER DIV : ACTIVIDAD
 	$nro_actividad=0;
	for($i=0;$i<=$con1;$i++)
	{	
		$recibe0=trim($_POST['amf_cmb_actividad-'.$i]);
		//echo $recibe0.'-';
		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='' || $recibe0!=0)
		{	
			$aa_codact[]=$recibe0;
			$nro_actividad++;
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "<pre>";
		print_r($aa_codact);
	  echo "</pre>"; */
	
	
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 2DO DIV : AUTORIZACION  DE ANUNCIOS
	$nro_anu=0;
 	for($i=0;$i<=$con2;$i++)
	{	
		$recibe0=trim($_POST['aa_cmb_anuncio-'.$i]);
		//$recibe1=trim($_POST['aa_nrolad-'.$i]);
		
		if($_POST['aa_nrolad-'.$i]== NULL || $_POST['aa_nrolad-'.$i]=='')
			$recibe1=0.0;
		else $recibe1=$_POST['aa_nrolad-'.$i];
		if($_POST['aa_aaa-'.$i]== NULL || $_POST['aa_aaa-'.$i]=='')
			$recibe2=0.0;
		else $recibe2=$_POST['aa_aaa-'.$i];
		if($_POST['aa_ava-'.$i]== NULL || $_POST['aa_ava-'.$i]=='')
			$recibe3=0.0;	
		else $recibe3=$_POST['aa_ava-'.$i];
		$recibe4=trim($_POST['aa_nroexp-'.$i]);
		$recibe5=trim($_POST['aa_nrolic-'.$i]);
			$new_date=str_replace("/","-",$_POST['aa_fecexp-'.$i]);
		$recibe6=date('d/M/Y', strtotime($new_date));
			$new_date=str_replace("/","-",$_POST['aa_fecven-'.$i]);
		$recibe7=date('d/M/Y', strtotime($new_date));
		
		
		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='')
		{
			$aa_cmb_anuncio[]=$recibe0;
			$aa_nrolad[]=$recibe1;
			$aa_aaa[]=$recibe2;
			$aa_ava[]=$recibe3;
			$aa_nroexp[]=$recibe4;
			$aa_nrolic[]=$recibe5;
			$aa_fecexp[]=$recibe6;
			$aa_fecven[]=$recibe7;
			$nro_anu++;
		}
	}
	
	/*//IMPRESION DE MATRIZ
	  echo "<pre>";
		print_r($aa_cmb_anuncio);
        print_r($aa_nrolad);
        print_r($aa_aaa);
		print_r($aa_ava);
		print_r($aa_nroexp);
		print_r($aa_nrolic);
		print_r($aa_fecexp);
		print_r($aa_fecven);
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
	$dg_unicodpredial=$_POST['dg_unicodpredial'];   

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ic	
	$ic_cmb_tipocon=trim($_POST['ic_cmb_tipocon']);
	$ic_nomcom=trim($_POST['ic_nomcom']);
	$ic_cmb_tipoide=trim($_POST['ic_cmb_tipoide']);
	
	$ic_nombres=trim($_POST['nombres']);
	$ic_ape_paterno=trim($_POST['ape_paterno']);
	$ic_ape_materno=trim($_POST['ape_materno']);

	$ic_nrodoc=$_POST['ic_nrodoc'];
	$ic_ruc=$_POST['ic_ruc'];
	$ic_razsocial=$_POST['ic_razsocial'];
	$ic_cmb_condcon=trim($_POST['ic_cmb_condcon']);
		
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
	
	/*echo $departamentos.' '.$provincias.' '.$distritos;*/
	
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
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ amf
	
	if($_POST['au_predcat']==NULL || $_POST['au_predcat']=='') 
		$au_predcat=0.0;
	else $au_predcat=$_POST['au_predcat'];

	if($_POST['au_viapub']==NULL || $_POST['au_viapub']=='') 
		$au_viapub=0.0;
	else $au_viapub=$_POST['au_viapub'];

	if($_POST['au_bc']==NULL || $_POST['au_bc']=='') 
		$au_bc=0.0;
	else $au_bc=$_POST['au_bc'];

	//$au_total=trim($_POST['au_total']); //se calcelarán por reporte
	
	if($_POST['av_predcat']==NULL || $_POST['av_predcat']=='') 
		$av_predcat=0.0;
	else $av_predcat=$_POST['av_predcat'];
	
	if($_POST['av_viapub']==NULL || $_POST['av_viapub']=='') 
		$av_viapub=0.0;
	else $av_viapub=$_POST['av_viapub'];
	
	if($_POST['av_bc']==NULL || $_POST['av_bc']=='') 
		$av_bc=0.0;
	else $av_bc=$_POST['av_bc'];

	//$av_total=trim($_POST['av_total']); //se calcelarán por reporte
	
	$aae_nroexp=(int)$_POST['aae_nroexp'];
	$aae_numlic=(int)$_POST['aae_numlic'];
	
		$new_date=str_replace("/","-",$_POST['aae_fecexp']);
	$aae_fecexp=date('d/M/Y', strtotime($new_date));
	
		$new_date=str_replace("/","-",$_POST['aae_fecven']);
	$aae_fecven=date('d/M/Y', strtotime($new_date));
	
		$new_date=str_replace("/","-",$_POST['aae_iniact']);
	$aae_iniact=date('d/M/Y', strtotime($new_date));
	
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ic
	$ic_cmb_conddec=trim($_POST['ic_cmb_conddec']); 
	$ic_cmb_docpre=trim($_POST['ic_cmb_docpre']); 
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
	//$f_fecha_grabado=date('d/m/Y');
	$f_fecha_grabado=date('d/m/Y\TH:i:s',time() - 3600);

		
?>