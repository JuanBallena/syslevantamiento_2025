<?php
require_once 'model/Fichas_p.php';

$unidad = $_POST['unidad'];
$codCatastral = $_POST['codCatastral'];

$oFichaNueva = new Fichas_p();
$CodigoCatastral = $oFichaNueva->validaUnidad($unidad,$codCatastral);  
if(!empty($CodigoCatastral))
	echo "ok";
else
	echo "";
?>