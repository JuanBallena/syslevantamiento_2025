<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $texto = isset($_GET['q']) ? trim($_GET['q']) : '';

  if ($texto !== '') {
    $sql = "SELECT codi_uso, desc_uso 
            FROM tf_usos 
            WHERE desc_uso ILIKE $1 
            ORDER BY desc_uso ASC 
            LIMIT 20";
    $params = ["%{$texto}%"];
    $result = $BD->queryParams($sql, $params);
  } else {

    $sql = "SELECT codi_uso, desc_uso
            FROM tf_usos
            ORDER BY desc_uso ASC
            LIMIT 20";
    $result = $BD->query($sql);
  }

  $usos = pg_fetch_all($result) ?: [];

  createResponse(true, $usos);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
