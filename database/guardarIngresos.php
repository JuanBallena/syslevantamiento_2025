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

  if (!is_array($input) || empty($input)) {
    throw new Exception("No se recibieron datos válidos para insertar.");
  }

  $placeholders = [];
  $params = [];
  $count = 1;

  foreach ($input as $fila) {
    $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ")";
    array_push($params, $fila['id_ficha'], $fila['id_puerta']);
  }

  $sql = "INSERT INTO tf_ingresos (id_ficha, id_puerta)
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
