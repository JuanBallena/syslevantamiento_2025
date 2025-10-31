<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $texto = isset($_GET['q']) ? trim($_GET['q']) : '';

  $sql = "SELECT *
        FROM ext_declarantes
        WHERE dni ILIKE $1 || '%'
        ORDER BY dni ASC
        LIMIT 20";
  $params = [$texto];
  $result = $BD->queryParams($sql, $params);

  $declarantes = pg_fetch_all($result) ?: [];

  createResponse(true, $declarantes);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
