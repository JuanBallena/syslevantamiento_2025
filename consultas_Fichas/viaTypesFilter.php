<?php
require_once 'model/database.php';
require_once 'model/TipoVia.php';

$dataPost = json_decode(file_get_contents("php://input"), true);

$textFiltrado = $dataPost['autocompleteText'];

$oTipoViasFiltrada = new TipoVia();
$tipoViasFiltradas = $oTipoViasFiltrada->ObtenerTipoViaFiltrada($textFiltrado);

echo json_encode($tipoViasFiltradas, true);

?>