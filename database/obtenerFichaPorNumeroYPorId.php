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

  if (empty($input['nume_ficha']) || empty($input['id_ficha'])) {
    createResponse(false, [], "Los parámetros 'nume_ficha' e 'id_ficha' son requeridos.");
    exit;
  }

  $numeFicha = $input['nume_ficha'];
  $idFicha = $input['id_ficha'];

  // Instancia de base de datos
  $BD = new DBPostgres();
  $BD->conectar();

  // Consulta con ambas condiciones
  $sql = "
    SELECT *
    FROM tf_fichas
    WHERE nume_ficha = $1
      AND id_ficha   = $2
  ";

  $result = $BD->queryParams($sql, [$numeFicha, $idFicha]);

  // Procesar resultados
  if (pg_num_rows($result) > 0) {
    $ficha = pg_fetch_assoc($result);
    createResponse(true, [$ficha], "");
  } else {
    // createResponse(false, [], "No existe ficha con nume_ficha = {$numeFicha} e id_ficha = {$idFicha}.");
    createResponse(false, [], "No se encontró ninguna ficha coincidente.");
  }

} catch (Exception $e) {
  createResponse(false, [], "Error al obtener ficha: " . $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
