<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  // Leer input JSON o POST
  $input = $_POST;
  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  if (empty($input['numero_ficha'])) {
    createResponse(false, [], "El parámetro 'numero_ficha' es requerido.");
    exit;
  }

  $idFicha = $input['numero_ficha'];

  // Instancia de base de datos
  $BD = new DBPostgres();
  $BD->conectar();

  // Consulta con parámetros
  $sql = "SELECT * FROM tf_fichas WHERE nume_ficha = $1";
  $result = $BD->queryParams($sql, [$idFicha]);

  // Procesar resultados
  if (pg_num_rows($result) > 0) {
    $ficha = pg_fetch_assoc($result);
    createResponse(true, $ficha, "Ficha encontrada, cambiar número de ficha.");
  } else {
    createResponse(false, [], "No se encontró la ficha con ID {$idFicha}.");
  }

} catch (Exception $e) {
  createResponse(false, [], "Error al obtener ficha: " . $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
