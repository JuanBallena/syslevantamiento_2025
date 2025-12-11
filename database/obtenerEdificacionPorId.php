<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  // Leer input JSON o POST
  $input = $_POST;
  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  if (empty($input['id_edificacion'])) {
    createResponse(false, [], "El parámetro 'id_edificacion' es requerido.");
    exit;
  }

  $idEdificacion = $input['id_edificacion'];

  // Instancia de base de datos
  $BD = new DBPostgres();
  $BD->conectar();

  // Consulta con parámetros
  $sql = "SELECT * FROM tf_edificaciones WHERE id_edificacion = $1";
  $result = $BD->queryParams($sql, [$idEdificacion]);

  // Procesar resultados
  if (pg_num_rows($result) > 0) {
    $edificacion = pg_fetch_assoc($result);
    createResponse(true, $edificacion, "Edificacion encontrado, cambiar número de edifica.");
  } else {
    createResponse(false, [], "No se encontró edificación.");
  }

} catch (Exception $e) {
  createResponse(false, [], "Error al obtener edificación: " . $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
