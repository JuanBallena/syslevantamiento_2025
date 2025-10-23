<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $input = $_POST;

  // Si viene en JSON puro
  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  $BD = new DBPostgres();
  $BD->conectar();

  // Validar que sea un arreglo con filas
  if (!is_array($input) || empty($input)) {
    throw new Exception("No se recibieron datos válidos para insertar.");
  }

  $placeholders = [];
  $params = [];
  $count = 1;

  // Recorremos cada litigante recibido
  foreach ($input as $fila) {
    // Generamos los placeholders ($1, $2, $3, ...)
    $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ")";

    // Agregamos los valores
    array_push(
      $params,
      $fila['id_ficha'] ?? null,
      $fila['id_persona'] ?? null,
      $fila['codi_contribuye'] ?? null
    );
  }

  $sql = "
    INSERT INTO tf_litigantes (id_ficha, id_persona, codi_contribuye)
    VALUES " . implode(", ", $placeholders) . "
    RETURNING *;
  ";

  $insertados = $BD->insert($sql, $params);

  createResponse(true, $insertados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
