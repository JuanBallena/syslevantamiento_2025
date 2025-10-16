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

  $placeholders = [];
  $params = [];
  $count = 1;

  foreach ($input as $fila) {
    $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ")";
    array_push(
      $params,
      $fila['id_puerta'],
      $fila['id_lote'],
      $fila['codi_puerta'],
      $fila['tipo_puerta'],
      $fila['nume_muni'],
      $fila['cond_nume'],
      $fila['id_via'],
      $fila['nume_certificacion'],
    );
  }

  $sql = "INSERT INTO tf_puertas (id_puerta, id_lote, codi_puerta, tipo_puerta, nume_muni, cond_nume, id_via, nume_certificacion)
          VALUES " . implode(", ", $placeholders) . " RETURNING *";

  $insertados = $BD->insert($sql, $params);

  createResponse(true, $insertados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
