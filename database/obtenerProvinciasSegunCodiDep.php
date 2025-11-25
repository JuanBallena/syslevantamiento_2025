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

  // Obtener cod_dep desde GET o JSON/POST
  $codDep = $_GET['codi_dep'] ?? ($input['codi_dep'] ?? null);

  $BD = new DBPostgres();
  $BD->conectar();

  if (!empty($codDep)) {

    // Provincias del departamento
    $sql = "
  SELECT DISTINCT codi_pro, descri
FROM tf_ubigeos
WHERE codi_dep = $1
  AND codi_pro <> '00'
  AND codi_dis = '00'
ORDER BY codi_pro;
    ";

    $result = $BD->queryParams($sql, [$codDep]);

  } else {
    createResponse(false, [], "Falta cod_dep");
    exit;
  }

  $provincias = pg_fetch_all($result) ?: [];

  createResponse(true, $provincias);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
