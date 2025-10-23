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
    // genera 13 placeholders consecutivos ($1, $2, ..., $13, luego $14, $15, ...)
    $filaPlaceholders = [];
    for ($i = 0; $i < 13; $i++) {
      $filaPlaceholders[] = '$' . $count++;
    }

    $placeholders[] = '(' . implode(', ', $filaPlaceholders) . ')';

    // agregar valores de la fila en el mismo orden
    array_push(
      $params,
      $fila['id_ficha'] ?? null,
      $fila['id_persona'] ?? null,
      $fila['form_adquisicion'] ?? null,
      $fila['fecha_adquisicion'] ?? null,
      $fila['porc_cotitular'] ?? null,
      $fila['esta_civil'] ?? null,
      $fila['fax'] ?? null,
      $fila['telf'] ?? null,
      $fila['anexo'] ?? null,
      $fila['email'] ?? null,
      $fila['nume_titular'] ?? null,
      $fila['codi_contribuyente'] ?? null,
      $fila['cond_titular'] ?? null
    );
  }

  $sql = "
    INSERT INTO tf_titulares (
      id_ficha,
      id_persona,
      form_adquisicion,
      fecha_adquisicion,
      porc_cotitular,
      esta_civil,
      fax,
      telf,
      anexo,
      email,
      nume_titular,
      codi_contribuyente,
      cond_titular
    )
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
