<?php 				
	require_once 'model/database_catastro.php';
	require_once 'model/constantes.php';
	require_once 'model/Fichas_p.php';

	$sector = $_POST['sector'];
	$manzana = $_POST['manzana'];

	# Validar referencia catastral
	$oFichaNueva = new Fichas_p();
	$fichas = $oFichaNueva->ReportexReferencia($sector, $manzana);	

	if(!empty($fichas)) 
		echo json_encode($fichas)
	
?>