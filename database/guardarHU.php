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

  $sql = "INSERT INTO tf_hab_urbana (
            id_hab_urba,
            grup_urba,
            tipo_hab_urba,
            nomb_hab_urba,
            codi_hab_urba,
            id_ubi_geo
          )
          VALUES ($1, $2, $3, $4, $5, $6)
          RETURNING *";

  $registro = $BD->insert($sql, $input);

  createResponse(true, $registro);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
