<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  $BD = new DBPostgres();
  $BD->conectar();

  // Departamentos = prov 00 y dist 00
  $sql = "
    SELECT DISTINCT codi_dep, descri
    FROM tf_ubigeos
    WHERE codi_pro = '00' AND codi_dis = '00'
    ORDER BY codi_dep ASC
  ";

  $result = $BD->query($sql);

  if (!$result) {
    throw new Exception(pg_last_error());
  }

  $resultados = pg_fetch_all($result) ?: [];

  createResponse(true, $resultados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
