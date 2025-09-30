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

  $sql = "INSERT INTO tf_manzanas (id_mzna, id_sector, codi_mzna, nume_mzna)
          VALUES ($1, $2, $3, $4)
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

// $datosFicha = [
//   "id_ficha" => "auto: año + ubigeo + tipo_ficha + nume_ficha",
//   "tipo_ficha" => "formulario: 01-05",
//   "nume_ficha" => "formulario: 7 caracteres",
//   "id_lote" => "tabla: lote",
//   "declarante" => "formulario: dni + ref. técnico",
//   "fecha_declarante" => "pdf",
//   "supervisor" => "dni",
//   "fecha_supervision" => "pdf",
//   "tecnico" => "dni",
//   "fecha_levantamiento" => "guardar",
//   "verificador" => "dni",
//   "fecha_verificacion" => "pdf",
//   "nume_registro" => "pdf",
//   "id_uni_cat" => "tabla: uni_cat",
//   "activo" => "1"
// ];
