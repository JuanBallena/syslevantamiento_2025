<?php

class InstalacionesRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarInstalacionesMultiple(array $data): int
  {
    $placeholders = [];
    $params = [];
    $count = 1;

    foreach ($data as $fila) {
      $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ")";

      array_push(
        $params,
        $fila['id_instalacion'] ?? null,
        $fila['id_ficha'] ?? null,
        $fila['codi_instalacion'] ?? null,
        $fila['codi_obra'] ?? null,
        $fila['fecha'] ?? null,
        $fila['mep'] ?? null,
        $fila['ecs'] ?? null,
        $fila['ecc'] ?? null,
        $fila['dime_largo'] ?? null,
        $fila['dime_ancho'] ?? null,
        $fila['dime_alto'] ?? null,
        $fila['prod_total'] ?? null,
        $fila['uni_med'] ?? null,
        $fila['uca'] ?? null
      );
    }

    $sql = "
    INSERT INTO tf_instalaciones (
      id_instalacion, id_ficha, codi_instalacion, codi_obra,
      fecha, mep, ecs, ecc, dime_largo, dime_ancho,
      dime_alto, prod_total, uni_med, uca
    )
    VALUES " . implode(", ", $placeholders) . "
    RETURNING *;
  ";

    $result = $this->db->insert($sql, $params);

    // if (!$result || !isset($result['id_ficha'])) {
    //   throw new Exception("❌ Error al guardar ficha individual o no se obtuvo id_ficha.");
    // }

    return 1;
  }
}

// require_once "./_DBPostgres.php";
// require_once "./_CreateResponse.php";

// header("Content-Type: application/json; charset=UTF-8");

// try {
//   $input = $_POST;

//   if (empty($input)) {
//     $input = json_decode(file_get_contents("php://input"), true) ?? [];
//   }

//   $BD = new DBPostgres();
//   $BD->conectar();

//   if (!is_array($input) || empty($input)) {
//     throw new Exception("No se recibieron datos válidos para insertar.");
//   }

//   $placeholders = [];
//   $params = [];
//   $count = 1;

//   foreach ($input as $fila) {
//     $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ")";

//     array_push(
//       $params,
//       $fila['id_instalacion'] ?? null,
//       $fila['id_ficha'] ?? null,
//       $fila['codi_instalacion'] ?? null,
//       $fila['codi_obra'] ?? null,
//       $fila['fecha'] ?? null,
//       $fila['mep'] ?? null,
//       $fila['ecs'] ?? null,
//       $fila['ecc'] ?? null,
//       $fila['dime_largo'] ?? null,
//       $fila['dime_ancho'] ?? null,
//       $fila['dime_alto'] ?? null,
//       $fila['prod_total'] ?? null,
//       $fila['uni_med'] ?? null,
//       $fila['uca'] ?? null
//     );
//   }

//   $sql = "
//     INSERT INTO tf_instalaciones (
//       id_instalacion, id_ficha, codi_instalacion, codi_obra,
//       fecha, mep, ecs, ecc, dime_largo, dime_ancho,
//       dime_alto, prod_total, uni_med, uca
//     )
//     VALUES " . implode(", ", $placeholders) . "
//     RETURNING *;
//   ";

//   $insertados = $BD->insert($sql, $params);

//   createResponse(true, $insertados);

// } catch (Exception $e) {
//   createResponse(false, [], $e->getMessage());
// } finally {
//   if (isset($BD)) {
//     $BD->desconectar();
//   }
// }
