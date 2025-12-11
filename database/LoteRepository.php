<?php

class LoteRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarLote(array $data): bool
  {
    $sql = "INSERT INTO tf_lotes (id_lote, id_mzna, codi_lote, id_hab_urba, 
        mzna_dist, lote_dist, sub_lote_dist, estructuracion, zonificacion,
        cuc, zona_dist)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
        RETURNING id_lote";

    try {
      $result = $this->db->insert($sql, $data);


      return $result && isset($result['id_lote']);
    } catch (\Exception $e) {

      error_log("Error en Lote Repository: " . $e->getMessage());
      return false;
    }
  }

  public function obtenerLotePorId(string $idLote): array
  {
    $sql = "SELECT * FROM tf_lotes WHERE id_lote = $1";
    $result = $this->db->queryParams($sql, [$idLote]);

    if (pg_num_rows($result) > 0) {
      return pg_fetch_assoc($result);
    } else {
      return [];
    }
  }
}
/**
 * Obtener un lote por su ID.
 * @param int $id
 * @return array|null
 */
// public function obtenerLotePorId(int $id): ?array
// {
//   $query = "SELECT * FROM lotes WHERE id = $1 LIMIT 1";
//   $result = pg_query_params($this->db, $query, [$id]);

//   if (!$result) {
//     throw new Exception("❌ Error al obtener el lote: " . pg_last_error($this->db));
//   }

//   $lote = pg_fetch_assoc($result);
//   return $lote ?: null;
// }

// API REST

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

//   $sql = "INSERT INTO tf_lotes (id_lote, id_mzna, codi_lote, id_hab_urba,
//           mzna_dist, lote_dist, sub_lote_dist, estructuracion, zonificacion,
//           cuc, zona_dist)
//           VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
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
