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

  $sql = "INSERT INTO tf_lotes (id_lote, id_mzna, codi_lote, id_hab_urba, 
          mzna_dist, lote_dist, sub_lote_dist, estructuracion, zonificacion,
          cuc, zona_dist)
          VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
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
