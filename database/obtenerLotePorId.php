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

  if (empty($input['id_lote'])) {
    createResponse(false, [], "El parámetro 'id_lote' es requerido.");
    exit;
  }

  $idLote = $input['id_lote'];

  // Instancia de base de datos
  $BD = new DBPostgres();
  $BD->conectar();

  // Consulta con parámetros
  $sql = "SELECT * FROM tf_lotes WHERE id_lote = $1";
  $result = $BD->queryParams($sql, [$idLote]);

  // Procesar resultados
  if (pg_num_rows($result) > 0) {
    $lote = pg_fetch_assoc($result);
    createResponse(true, $lote, "Lote encontrado, cambiar número de lote.");
  } else {
    createResponse(false, [], "No se encontró lote.");
  }

} catch (Exception $e) {
  createResponse(false, [], "Error al obtener lote: " . $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
