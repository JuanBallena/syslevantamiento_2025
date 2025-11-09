<?php

class SunarpRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarSunarp(array $data): int
  {
    $sql = "INSERT INTO tf_sunarp (id_ficha, tipo_partida, nume_partida, fojas,
      asiento, fech_inscripcion, codi_decla_fabrica, asie_fabrica, fecha_fabrica)
          VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)
          RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_ficha'])) {
      throw new Exception("❌ Error al guardar sunarp o no se obtuvo id_ficha.");
    }

    return $result['id_ficha'];
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

//   $sql = "INSERT INTO tf_sunarp (id_ficha, tipo_partida, nume_partida, fojas,
//    asiento, fech_inscripcion, codi_decla_fabrica, asie_fabrica, fecha_fabrica)
//           VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)
//           RETURNING *";

//   $registro = $BD->insert($sql, $input);

//   createResponse(true, $registro);

// } catch (Exception $e) {
//   createResponse(false, [], $e->getMessage());
// } finally {
//   if (isset($BD)) {
//     $BD->desconectar();
//   }
// }
