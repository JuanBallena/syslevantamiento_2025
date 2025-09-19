<?php 
	require_once '../configuracion/Conexion_SIMTRUX.php';

	$v=$_POST["v"];
	
	$oCODIGOS_REFERENCIA_CATASTRAL = new SIMTRUX_Catastro();
	$CODIGOS_REFERENCIA_CATASTRAL = $oCODIGOS_REFERENCIA_CATASTRAL->ObtenerVia($v);

	if(!empty($CODIGOS_REFERENCIA_CATASTRAL))
		echo $CODIGOS_REFERENCIA_CATASTRAL->codcalle;
	else
		echo "";
?>