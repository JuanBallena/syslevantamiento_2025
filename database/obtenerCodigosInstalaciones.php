<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $sql = "SELECT * FROM tf_codigos_instalaciones";
  $result = $BD->query($sql);

  $codigosIntalaciones = pg_fetch_all($result) ?: [];

  createResponse(true, $codigosIntalaciones);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
