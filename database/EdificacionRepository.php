<?php

class EdificacionRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarEdificacion(array $data): int
  {
    $sql = "INSERT INTO tf_edificaciones (
      id_edificacion, 
      id_lote, 
      codi_edificacion, 
      tipo_edificacion, 
      nomb_edificacion, 
      clasificacion
    ) VALUES ($1, $2, $3, $4, $5, $6)
    RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_edificacion'])) {
      throw new Exception("❌ Error al guardar edificacion o no se obtuvo id_edificacion.");
    }

    return $result['id_edificacion'];
  }

  public function obtenerEdificacionPorId(string $idEdificacion): array
  {
    $sql = "SELECT * FROM tf_edificaciones WHERE id_edificacion = $1";
    $result = $this->db->queryParams($sql, [$idEdificacion]);

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

//   $sql = "INSERT INTO tf_edificaciones (
//     id_edificacion,
//     id_lote,
//     codi_edificacion,
//     tipo_edificacion,
//     nomb_edificacion,
//     clasificacion
//   ) VALUES ($1, $2, $3, $4, $5, $6)
//   RETURNING *";

//   $registro = $BD->insert($sql, $input);

//   createResponse(true, $registro);

// } catch (Exception $e) {
//   createResponse(false, [], $e->getMessage());
// } finally {
//   if (isset($BD)) {
//     $BD->desconectar();
//   }
// }
