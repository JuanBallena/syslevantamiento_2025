<?php 	
    $dg_dep=$_POST['dg_dep'];
	$dg_pro=$_POST['dg_pro'];
	$dg_dis=$_POST['dg_dis'];
	$ubigeo=$dg_dep.$dg_pro.$dg_dis;

	$total=$_POST['total'];	//NRO TITULARES
//****************************************** VARIABLES LIBRES FORMULARIO *********************
	$numficha=$_POST['numficha'];
	$numflote1=$_POST['numflote1'];   
	$numflote2=$_POST['numflote2'];
	
//-------------------------------------------------------------------------------------------------------
	//VERIFICAMOS CUANTOS INPUT Y SELECT ESTAMOS CAPTURANDO POR CADA COTITULAR
 	for($i=0;$i<$total;$i++)
	{	
		$recibe0=$_POST['dcc_nro_cotitular-'.$i];
		$recibe1=$_POST['dcc_total_cotitular-'.$i];
		$recibe2=trim($_POST['itc_cmb_tipotitu-'.$i]);
		$recibe3=$_POST['dcc_porcentaje-'.$i];
		$recibe4=$_POST['dg_codcontribuyente-'.$i];
		$recibe5=trim($_POST['itc_cmb_tipodoc-'.$i]);
		$recibe6=$_POST['itc_numdoc-'.$i];
		$recibe7=$_POST['itc_nombre_'.$i];
		$recibe8=$_POST['itc_paterno_'.$i];
		$recibe9=$_POST['itc_materno_'.$i];
		$recibe10=$_POST['itc_ruc-'.$i];
		$recibe11=$_POST['itc_razsocial-'.$i];
		$recibe12=trim($_POST['ct_cmb_formadq-'.$i]);
			$new_date=str_replace("/","-",$_POST['ct_fechaadq_'.$i]);
		$recibe13=date('d/M/Y', strtotime($new_date));
		$recibe14=trim($_POST['itc_cmb_condesptitu-'.$i]);
		$recibe15=$_POST['itc_numresexo-'.$i];
			$new_date=str_replace("/","-",$_POST['itc_fechainiexo_'.$i]);
		$recibe16=date('d/M/Y', strtotime($new_date));
			$new_date=str_replace("/","-",$_POST['itc_fechafinexo_'.$i]);
		$recibe17=date('d/M/Y', strtotime($new_date));
		$recibe18=$_POST['departamentos'.$i];
		$recibe19=$_POST['provincias'.$i];
		$recibe20=$_POST['distritos'.$i];
		
		if(strlen($recibe18)<2)
		{	/*echo "<script>alert('NO CAMBIÓ EL UBIGEO');</script>\n";*/
			$recibe18=$_POST['departamento'.$i];
			$recibe19=$_POST['provincia'.$i];
			$recibe20=$_POST['distrito'.$i];	
		}
		
		$recibe21=$_POST['dftc_telf-'.$i];
		$recibe22=$_POST['dftc_anexo-'.$i];
		$recibe23=$_POST['dftc_fax-'.$i];
		$recibe24=$_POST['dftc_email-'.$i];
		$recibe25=$_POST['dftc_codvia-'.$i];
		$recibe26=$_POST['dftc_tipovia-'.$i];
		$recibe27=$_POST['dftc_nomvia-'.$i];
		$recibe28=$_POST['dftc_nummuni-'.$i];
		$recibe29=$_POST['dftc_nomedi-'.$i];
		$recibe30=$_POST['dftc_numint-'.$i];
		$recibe31=$_POST['dftc_codhu-'.$i];
		$recibe32=$_POST['dftc_nomhu-'.$i];
		$recibe33=$_POST['dftc_zse-'.$i];
		$recibe34=$_POST['ddftc_mzna-'.$i];
		$recibe35=$_POST['dftc_lote-'.$i];
		$recibe36=$_POST['dftc_sublote-'.$i];

		/*echo $recibe1.'-'.$recibe2.'-'.$recibe3.'-';
		echo $recibe4.'-'.$recibe5.'-'.$recibe6.'-';
		echo $recibe7.'-'.$recibe8.'-'.$recibe9.'-';
		echo $recibe10.'-'.$recibe11.'-'.$recibe12.'-';
		echo $recibe13.'-'.$recibe14.'-'.$recibe15.'-';
		echo $recibe16.'-'.$recibe17.'-'.$recibe18.'-';
		echo $recibe19.'-'.$recibe20.'-'.$recibe21.'-';
		echo $recibe22.'-'.$recibe23.'-'.$recibe24.'-';
		echo $recibe25.'-'.$recibe26.'-'.$recibe27.'-';
		echo $recibe28.'-'.$recibe29.'-'.$recibe30.'-';
		echo $recibe31.'-'.$recibe32.'-'.$recibe33.'-';
		echo $recibe34.'-'.$recibe35.'-'.$recibe36.'-';*/
			
		//QUE NO PASEN LOS VACIOS
	
		//if ($recibe3!='' and $recibe6!='' and $recibe7!='' and $recibe8!='' and $recibe9!='' and $recibe5!='')
		//{
			$dcc_nro_cotitular[]=$recibe0;
			$dcc_total_cotitular[]=$recibe1;
			$itc_cmb_tipotitu[]=$recibe2;
			$dcc_porcentaje[]=$recibe3;
			$dg_codcontribuyente[]=$recibe4;
			$itc_cmb_tipodoc[]=$recibe5;
			$itc_numdoc[]=$recibe6;
			$itc_nombre[]=$recibe7;
			$itc_paterno[]=$recibe8;
			$itc_materno[]=$recibe9;
			$itc_ruc[]=$recibe10;
			$itc_razsocial[]=$recibe11;
			$ct_cmb_formadq[]=$recibe12;
			$ct_fechaadq[]=$recibe13;
			$itc_cmb_condesptitu[]=$recibe14;
			$itc_numresexo[]=$recibe15;
			$itc_fechainiexo[]=$recibe16;
			$itc_fechafinexo[]=$recibe17;
			$departamentos[]=$recibe18;
			$provincias[]=$recibe19;
			$distritos[]=$recibe20;
			$dftc_telf[]=$recibe21;
			$dftc_anexo[]=$recibe22;
			$dftc_fax[]=$recibe23;
			$dftc_email[]=$recibe24;
			$dftc_codvia[]=$recibe25;
			$dftc_tipovia[]=$recibe26;
			$dftc_nomvia[]=$recibe27;
			$dftc_nummuni[]=$recibe28;
			$dftc_nomedi[]=$recibe29;
			$dftc_numint[]=$recibe30;
			$dftc_codhu[]=$recibe31;
			$dftc_nomhu[]=$recibe32;
			$dftc_zse[]=$recibe33;
			$dftc_mzna[]=$recibe34;
			$dftc_lote[]=$recibe35;
			$dftc_sublote[]=$recibe36;
				
		//}
	}
	
/*	  echo "-----------------------------";	
		//IMPRESION DE MATRIZ
	  echo "<pre>";
		print_r($dcc_nro_cotitular);
        print_r($dcc_total_cotitular);
        print_r($itc_cmb_tipotitu);
		print_r($dcc_porcentaje);
		print_r($dg_codcontribuyente);
		print_r($itc_cmb_tipodoc);
		print_r($itc_numdoc);
		print_r($itc_nombre);
		print_r($itc_paterno);
		print_r($itc_materno);
		print_r($itc_ruc);
		print_r($itc_razsocial);
		print_r($ct_cmb_formadq);
        print_r($ct_fechaadq);
        print_r($itc_cmb_condesptitu);
		print_r($itc_numresexo);
		print_r($itc_fechainiexo);
		print_r($itc_fechafinexo);
		print_r($departamentos);
		print_r($provincias);
		print_r($distritos);
		print_r($dftc_telf);
		print_r($dftc_anexo);
		print_r($dftc_fax);
		print_r($dftc_email);
        print_r($dftc_codvia);
        print_r($dftc_tipovia);
		print_r($dftc_nomvia);
		print_r($dftc_nummuni);
		print_r($dftc_nomedi);
		print_r($dftc_numint);
		print_r($dftc_codhu);
		print_r($dftc_nomhu);
		print_r($dftc_zse);
		print_r($dftc_mzna);
		print_r($dftc_lote);
		print_r($dftc_sublote);
	  echo "</pre>"; */
	
	
	
	
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

	$ic_cmb_conddec=trim($_POST['ic_cmb_conddec']); 
	$ic_cmb_estficha=trim($_POST['ic_cmb_estficha']);
	
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