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

  $sql = "INSERT INTO tf_sectores (id_sector, id_ubi_geo, codi_sector, nomb_sector)
          VALUES ($1, $2, $3, $4)
          RETURNING *";

  $registro = $BD->insert($sql, [
    "13010101",
    "130101",
    "01",
    "Sector 1"
  ]);

  createResponse(true, $registro);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
