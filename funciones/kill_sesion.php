<?php
	session_start();
	
	//MATAMOS SESIONES DEL TITULAR
	if(isset($itc_cmb_tipotitu)) $_SESSION['itc_cmb_tipotitu']=$itc_cmb_tipotitu;
	if(isset($itc_numdoc1)) $_SESSION['itc_numdoc']=$itc_numdoc1;
	if(isset($itc_nombre1)) $_SESSION['itc_nombre']=$itc_nombre1;
	if(isset($itc_paterno1)) $_SESSION['itc_paterno']=$itc_paterno1;
	if(isset($itc_materno1)) $_SESSION['itc_materno']=$itc_materno1;

	if(isset($itc_ruc)) $_SESSION['itc_ruc']=$itc_ruc;
	if(isset($itc_razsocial)) $_SESSION['itc_razsocial']=$itc_razsocial;

	//MATAMOS SESIONES DE CODIGO REFERENCIAL
	unset($_SESSION['nro_cotitulares']); 
	unset($_SESSION['cuc8']); 
	unset($_SESSION['cuc4']);
	unset($_SESSION['sector']); 
	unset($_SESSION['manzana']); 
	unset($_SESSION['lote']); 
	unset($_SESSION['edifica']); 
	unset($_SESSION['entrada']); 
	unset($_SESSION['piso']); 
	unset($_SESSION['unidad']); 
	unset($_SESSION['hojacatastral']);
	
	unset($_SESSION['ic_condicion']); 
	unset($_SESSION['ic_estado']); 
	unset($_SESSION['dc']); 	  
?>