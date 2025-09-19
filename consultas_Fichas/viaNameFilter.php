<?php

require_once 'model/database.php';
require_once 'model/Vias.php';

$dataPost = json_decode(file_get_contents("php://input"), true);

$textFiltrado = $dataPost['autocompleteText'];

$oViasFiltrada = new Vias();
$viasFiltradas = $oViasFiltrada->ObtenerViasFiltradas($textFiltrado);

echo json_encode($viasFiltradas, true);

?>