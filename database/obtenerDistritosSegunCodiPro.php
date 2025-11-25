<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  // Detectar entrada (GET, POST, JSON)
  $input = $_POST;
  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  // Obtener parámetros
  $codiDep = $_GET['codi_dep'] ?? ($input['codi_dep'] ?? null);
  $codiPro = $_GET['codi_pro'] ?? ($input['codi_pro'] ?? null);

  if (empty($codiDep) || empty($codiPro)) {
    createResponse(false, [], "Faltan parámetros: codi_dep o codi_pro");
    exit;
  }

  $BD = new DBPostgres();
  $BD->conectar();

  // Distritos
  $sql = "
      SELECT codi_dis, descri
      FROM tf_ubigeos
      WHERE codi_dep = $1
        AND codi_pro = $2
        AND codi_dis <> '00'
      ORDER BY codi_dis ASC
  ";

  $result = $BD->queryParams($sql, [$codiDep, $codiPro]);

  $distritos = pg_fetch_all($result) ?: [];

  createResponse(true, $distritos);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
