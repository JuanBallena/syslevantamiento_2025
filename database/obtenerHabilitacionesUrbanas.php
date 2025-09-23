<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  $sql = "SELECT * FROM tf_hab_urbana";
  $result = $BD->query($sql);

  $estados = pg_fetch_all($result) ?: [];

  createResponse(true, $estados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
