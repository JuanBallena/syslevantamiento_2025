<?php
require_once 'model/DeleteViaPuertaTable.php';

//$v = file_get_contents("php://input", true);
$codigoPuerta = $_POST['codi_puerta'];

$deleteViaPuerta = new DeleteViaPuertaTable();
$deleteViaPuerta->update(
    $codigoPuerta
);
?>