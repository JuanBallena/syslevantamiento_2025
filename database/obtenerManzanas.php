<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  // ✅ Detectar si viene por GET o POST (o JSON)
  $input = $_POST;
  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  // ✅ Si viene por GET, también lo tomamos
  $idSector = $_GET['id_sector'] ?? ($input['id_sector'] ?? null);

  $BD = new DBPostgres();
  $BD->conectar();

  if (!empty($idSector)) {
    // 🔍 Filtrar por id_sector
    $sql = "SELECT * FROM tf_manzanas WHERE id_sector = $1";
    $result = $BD->queryParams($sql, [$idSector]);
  } else {
    // 🔍 Traer todas las manzanas
    $sql = "SELECT * FROM tf_manzanas";
    $result = $BD->query($sql);
  }

  $manzanas = pg_fetch_all($result) ?: [];

  createResponse(true, $manzanas);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
