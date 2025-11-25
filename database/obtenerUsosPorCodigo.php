<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $codiUso = isset($_GET['codi_uso']) ? trim($_GET['codi_uso']) : '';

  if ($codiUso !== '') {
    $sql = "SELECT codi_uso, desc_uso 
            FROM tf_usos 
            WHERE codi_uso ILIKE $1 
            ORDER BY desc_uso ASC 
            LIMIT 20";
    $params = ["%{$codiUso}%"];
    $result = $BD->queryParams($sql, $params);
  } else {

    $sql = "SELECT codi_uso, desc_uso
            FROM tf_usos
            ORDER BY codi_uso ASC
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
