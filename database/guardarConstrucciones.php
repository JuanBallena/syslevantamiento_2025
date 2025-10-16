<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";

header("Content-Type: application/json; charset=UTF-8");

try {
  // Obtener datos desde POST o JSON
  $input = $_POST;

  if (empty($input)) {
    $input = json_decode(file_get_contents("php://input"), true) ?? [];
  }

  if (!is_array($input) || empty($input)) {
    throw new Exception("No se enviaron registros válidos para insertar");
  }

  $BD = new DBPostgres();
  $BD->conectar();

  $placeholders = [];
  $params = [];
  $count = 1;

  // Recorrer cada fila (registro)
  foreach ($input as $fila) {
    $placeholders[] = "(" .
      "$" . ($count++) . ", " . // id_construccion
      "$" . ($count++) . ", " . // id_ficha
      "$" . ($count++) . ", " . // codi_construccion
      "$" . ($count++) . ", " . // nume_piso
      "$" . ($count++) . ", " . // fecha
      "$" . ($count++) . ", " . // mep
      "$" . ($count++) . ", " . // ecs
      "$" . ($count++) . ", " . // ecc
      "$" . ($count++) . ", " . // estr_muro_col
      "$" . ($count++) . ", " . // estr_techo
      "$" . ($count++) . ", " . // acab_piso
      "$" . ($count++) . ", " . // acab_puerta_ven
      "$" . ($count++) . ", " . // acab_revest
      "$" . ($count++) . ", " . // acab_bano
      "$" . ($count++) . ", " . // inst_elect_sanita
      "$" . ($count++) . ", " . // area_declarada
      "$" . ($count++) . ", " . // area_verificada
      "$" . ($count++) .        // uca
    ")";

    array_push(
      $params,
      $fila['id_construccion'] ?? null,
      $fila['id_ficha'] ?? null,
      $fila['codi_construccion'] ?? null,
      $fila['nume_piso'] ?? null,
      $fila['fecha'] ?? null,
      $fila['mep'] ?? null,
      $fila['ecs'] ?? null,
      $fila['ecc'] ?? null,
      $fila['estr_muro_col'] ?? null,
      $fila['estr_techo'] ?? null,
      $fila['acab_piso'] ?? null,
      $fila['acab_puerta_ven'] ?? null,
      $fila['acab_revest'] ?? null,
      $fila['acab_bano'] ?? null,
      $fila['inst_elect_sanita'] ?? null,
      $fila['area_declarada'] ?? null,
      $fila['area_verificada'] ?? null,
      $fila['uca'] ?? null
    );
  }

  // Armar el SQL completo
  $sql = "INSERT INTO tf_construcciones (
            id_construccion,
            id_ficha,
            codi_construccion,
            nume_piso,
            fecha,
            mep,
            ecs,
            ecc,
            estr_muro_col,
            estr_techo,
            acab_piso,
            acab_puerta_ven,
            acab_revest,
            acab_bano,
            inst_elect_sanita,
            area_declarada,
            area_verificada,
            uca
          )
          VALUES " . implode(", ", $placeholders) . " RETURNING *";

  // Ejecutar inserción múltiple
  $insertados = $BD->insert($sql, $params);

  createResponse(true, $insertados);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
