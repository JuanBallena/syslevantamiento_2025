<?php

require_once "./DBPostgres.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $sql = "SELECT * FROM tf_tipo_material";
  $result = $BD->query($sql);

  $tipoMateriales = pg_fetch_all($result);

  if ($tipoMateriales) {
    echo json_encode([
      "success" => true,
      "data" => $tipoMateriales
    ], JSON_UNESCAPED_UNICODE);
  } else {
    echo json_encode([
      "success" => false,
      "data" => []
    ]);
  }
} catch (Exception $e) {
  echo json_encode([
    "success" => false,
    "error" => $e->getMessage()
  ]);
}
