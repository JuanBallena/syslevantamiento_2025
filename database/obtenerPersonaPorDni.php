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

  if (empty($input['nume_doc'])) {
    createResponse(false, [], "El parámetro 'nume_doc' es requerido.");
    exit;
  }

  $nume_doc = $input['nume_doc'];

  // Instancia de base de datos
  $BD = new DBPostgres();
  $BD->conectar();

  // Consulta con parámetros
  $sql = "SELECT * FROM tf_personas WHERE nume_doc = $1";
  $result = $BD->queryParams($sql, [$nume_doc]);

  // Procesar resultados
  if (pg_num_rows($result) > 0) {
    $persona = pg_fetch_assoc($result);
    createResponse(true, $persona, "Exit");
  } else {
    createResponse(false, [], "No Found");
  }

} catch (Exception $e) {
  createResponse(false, [], "Error al obtener ficha: " . $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
