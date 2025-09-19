<?php
require_once 'model/Vias.php';
require_once 'model/database.php';

$v = file_get_contents("php://input", true);


$oVia = new Vias();          
$Via = $oVia->ObtenerVia($v); 

if(!empty($Via))
	echo json_encode($Via);
else
	echo "";
?>
