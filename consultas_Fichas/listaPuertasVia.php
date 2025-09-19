<?php
require_once 'model/Vias_p.php';
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';

//$dataPost = file_get_contents("php://input", true);
$idUniCat = $_POST['idUniCat'];
$idVia = $_POST['idVia'];

$oPuerta = new Vias_p();
$Puertas = $oPuerta->ObtenerPuertas($idUniCat, $idVia); 

if(!empty($Puertas))
	
    echo json_encode($Puertas);
    
else
	echo "";
?>