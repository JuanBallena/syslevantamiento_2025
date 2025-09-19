<?php
require_once 'model/DeletePuertaTable.php';

//$v = file_get_contents("php://input", true);
$codigoPuerta = $_POST['codi_puerta'];

$deletePuerta = new DeletePuertaTable();
$deletePuerta->update(
    $codigoPuerta
);
?>