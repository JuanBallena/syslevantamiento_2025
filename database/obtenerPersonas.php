<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $texto = isset($_GET['q']) ? trim($_GET['q']) : '';

  $sql = "SELECT nume_doc, nombres, ape_materno, ape_paterno
        FROM tf_personas
        WHERE nume_doc ILIKE $1 || '%'
        ORDER BY nume_doc ASC
        LIMIT 20";
  $params = [$texto];
  $result = $BD->queryParams($sql, $params);

  $personas = pg_fetch_all($result) ?: [];

  createResponse(true, $personas);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
