<?php	
	error_reporting(E_ALL ^ E_NOTICE);
	
    $dg_dep=$_POST['input-department'];
	$dg_pro=$_POST['input-province'];
	$dg_dis=$_POST['input-distrit'];
	$ubigeo=$dg_dep.$dg_pro.$dg_dis;
	
	$con1=$_POST['contador1']; // VIAS
	$con2=$_POST['contador2']; // CONSTRUCCIONES
	
	//---------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO PARA EL 1ER DIV : VIAS
 	$nro_vias=0;
	for($i=0;$i<=$con1;$i++)
	{	
		$recibe0= (isset($_POST['upc_Vias-'.$i]))? $_POST['upc_Vias-'.$i]:'';		
		$recibe1= (isset($_POST['upc_TipoVias-'.$i]))? $_POST['upc_TipoVias-'.$i]:'';
		$recibe2= (isset($_POST['upc_Vias-'.$i]))? $_POST['upc_Vias-'.$i]:'';
		$recibe3= (isset($_POST['upc_tipPuertas-'.$i]))? $_POST['upc_tipPuertas-'.$i]:'';
		$recibe4= (isset($_POST['upc_nroMuni-'.$i]))? $_POST['upc_nroMuni-'.$i]:'';

		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='')
		{	
			$upc_codvia[]=$recibe0;
			$upc_TipoVias[]=$recibe1;
			$upc_nom[]=$recibe2;
			$upc_codpue[]=trim($recibe3);
			$upc_num[]=$recibe4;
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
		$recibe0=trim($_POST['input-nroPiso-'.$i]);
		$recibe1=trim($_POST['cmb_tipo_material-'.$i]);
		$recibe2=strtoupper($_POST['cmb_tipo_myc-'.$i]);
		$recibe3=strtoupper($_POST['cmb_tipo_techo-'.$i]);
		$recibe4=strtoupper($_POST['cmb_tipo_pisos-'.$i]);
		$recibe5=strtoupper($_POST['cmb_tipo_pyv-'.$i]);
		
		//QUE NO PASEN LOS VACIOS
		if ($recibe0!='')
		{
			$dftc_nroPiso[]=$recibe0;
			$cmb_tipo_material[]=$recibe1;
			$cmb_tipo_myc[]=$recibe2;
			$cmb_tipo_techo[]=$recibe3;
			$cmb_tipo_pisos[]=$recibe4;
			$cmb_tipo_pyv[]=$recibe5;
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
		
		
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ REFERENCIA CATASTRAL	

	$dg_sector=$_POST['input-sector'];
	$dg_manzana=$_POST['input-manzana'];   
	$dg_lote=$_POST['input-lote'];
	$dg_edificacion=$_POST['input-edifica'];
	$dg_entrada=$_POST['input-entrada'];   
	$dg_piso=$_POST['input-piso'];
	$dg_unidad=$_POST['input-unidad'];
	//echo $dg_unidad;
	$dg_codcatastral=$dg_dis.$dg_sector.$dg_manzana.$dg_lote;

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ UBICACION PREDIO CATASTRAL
	$upc_codhu=$_POST['urban-authorization-name-value'];
	//echo $upc_codhu;
	$upc_cmb_estado_unidad= (isset($_POST['select-estados']))? trim($_POST['select-estados']):'';
	echo $upc_cmb_estado_unidad;
	$upc_nomhu= $_POST['urban-authorization-name-autocomplete'];   
	$upc_zse= (isset($_POST['input-grupoHU']))? $_POST['input-grupoHU']:'';
	$upc_nomzse= (isset($_POST['input-nro_Etapa']))? $_POST['input-nro_Etapa']:'';
	$upc_mzna= (isset($_POST['input-mzna_Dist']))? $_POST['input-mzna_Dist']:''; 
	$upc_lote= (isset($_POST['input-lote_Dist']))? $_POST['input-lote_Dist']:'';  
	$upc_sublote= (isset($_POST['input-subLote_Dist']))? $_POST['input-subLote_Dist']:''; 

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ DESCRIPCION DEL PREDIO

	$dp_cmb_usoprecat= (isset($_POST['dp_cmb_usoprecat']))? trim($_POST['dp_cmb_usoprecat']):'';
	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++SERVICIOS BASICOS
	$sb_luz = (isset($_POST['sb_luz']))? $_POST['sb_luz']:0;
	if($sb_luz!=1) 		$sb_luz=2;

	$sb_agua = (isset($_POST['sb_agua']))? $_POST['sb_agua']:0;
	if($sb_agua!=1)		 $sb_agua=2;

	$sb_telefono = (isset($_POST['sb_telefono']))? $_POST['sb_telefono']:0;
	if($sb_telefono!=1)	 $sb_telefono=2;

	$sb_desague = (isset($_POST['sb_desague']))? $_POST['sb_desague']:0;
	if($sb_desague!=1) 	 $sb_desague=2;

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++INFORMACION COMPLEMENTARIA
	$cant_med=trim($_POST['cant_med']); 
	$sb_sub = (isset($_POST['sb_sub']))? $_POST['sb_sub']:0;
	if($sb_sub!=1) 		$sb_sub=2;

	$sb_acu = (isset($_POST['sb_acu']))? $_POST['sb_acu']:0;
	if($sb_acu!=1)		 $sb_acu=2;

	$sb_ind = (isset($_POST['sb_ind']))? $_POST['sb_ind']:0;
	if($sb_ind!=1)	 $sb_ind=2;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ observacion
	$observaciones= (isset($_POST['observaciones']))? trim($_POST['observaciones']):'';
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ FIRMA
	$f_dni=$_POST['input-tc_dni'];
	$f_nom=$_POST['input-tc_nombre'];
	$f_paterno=$_POST['input-tc_apellidoP'];
	$f_materno=$_POST['input-tc_apellidoM'];
			
	$new_date=str_replace("/","-",$_POST['dftc_tc_fecha']);
	$f_fechatec=date('d/M/Y', strtotime($new_date));
	
	$f_fecha_grabado=date('d/m/Y\TH:i:s',time() - 3600);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++IMAGEN+++++++++
	$imagen=$_POST['img_adj'];


?>
