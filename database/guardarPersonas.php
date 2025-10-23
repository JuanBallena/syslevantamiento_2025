<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $input = $_POST;

  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  $BD = new DBPostgres();
  $BD->conectar();

  // Validar que sea un arreglo de filas
  if (!is_array($input) || empty($input)) {
    throw new Exception("No se recibieron datos válidos para insertar.");
  }

  $placeholders = [];
  $params = [];
  $count = 1;

  foreach ($input as $fila) {
    $placeholders[] = "("
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ", "
      . "$" . ($count++) . ")";

    array_push(
      $params,
      $fila['id_persona'] ?? null,
      $fila['nume_doc'] ?? null,
      $fila['tipo_doc'] ?? null,
      $fila['tipo_persona'] ?? null,
      $fila['nombres'] ?? null,
      $fila['ape_paterno'] ?? null,
      $fila['ape_materno'] ?? null,
      $fila['tipo_persona_juridica'] ?? null,
      $fila['tipo_funcion'] ?? null,
      $fila['razon_social'] ?? null
    );
  }

  $sql = "INSERT INTO tf_personas (
            id_persona, nume_doc, tipo_doc, tipo_persona, 
            nombres, ape_paterno, ape_materno, 
            tipo_persona_juridica, tipo_funcion, razon_social
          )
          VALUES " . implode(", ", $placeholders) . "
          RETURNING *";

  $insertados = $BD->insert($sql, $params);

  createResponse(true, $insertados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
