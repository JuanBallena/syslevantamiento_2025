<?php

class ViasHUSRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarViasHUSMultiple(array $data): int
  {
    $placeholders = [];
    $params = [];
    $count = 1;

    foreach ($data as $fila) {
      $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ")";
      array_push($params, $fila['id_hab_urba'], $fila['id_via']);
    }

    $sql = "INSERT INTO tf_vias_hab_urba (id_hab_urba, id_via)
          VALUES " . implode(", ", $placeholders) . "
          RETURNING *";

    $result = $this->db->insert($sql, $params);

    // if (!$result || !isset($result['id_ficha'])) {
    //   throw new Exception("❌ Error al guardar ficha individual o no se obtuvo id_ficha.");
    // }

    return 1;
  }

  public function obtenerRegistro($id_hab_urba, $id_via): array
  {
    $sql = "SELECT *
            FROM tf_vias_hab_urba
            WHERE id_hab_urba = $1 AND id_via = $2";

    $params = [$id_hab_urba, $id_via];

    $result = $this->db->queryParams($sql, $params);

    if (pg_num_rows($result) > 0) {
      return pg_fetch_assoc($result);
    } else {
      return [];
    }
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

//   // Validar que sea un arreglo de filas
//   if (!is_array($input) || empty($input)) {
//     throw new Exception("No se recibieron datos válidos para insertar.");
//   }

//   $placeholders = [];
//   $params = [];
//   $count = 1;

//   foreach ($input as $fila) {
//     $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ")";
//     array_push($params, $fila['id_hab_urba'], $fila['id_via']);
//   }

//   $sql = "INSERT INTO tf_vias_hab_urba (id_hab_urba, id_via)
//           VALUES " . implode(", ", $placeholders) . "
//           RETURNING *";

//   $insertados = $BD->insert($sql, $params);

//   createResponse(true, $insertados);

// } catch (Exception $e) {
//   createResponse(false, [], $e->getMessage());
// } finally {
//   if (isset($BD)) {
//     $BD->desconectar();
//   }
// }
