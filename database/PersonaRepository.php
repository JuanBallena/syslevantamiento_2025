<?php

class PersonaRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarPersona(array $data): int
  {
    $sql = "INSERT INTO tf_personas (
      id_persona,
      nume_doc,
      tipo_doc,
      tipo_persona,
      nombres,
      ape_paterno,
      ape_materno,
      tipo_persona_juridica,
      tipo_funcion,
      razon_social
    )
    VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)
    RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_persona'])) {
      throw new Exception("❌ Error al guardar persona o no se obtuvo id_persona.");
    }

    return $result['id_persona'];
  }

  public function obtenerPersonaPorNumeDoc(string $nume_doc): ?array
  {
    $sql = "SELECT * FROM tf_personas WHERE nume_doc = $1";
    $result = $this->db->queryParams($sql, [$nume_doc]);

    if (pg_num_rows($result) > 0) {
      return pg_fetch_assoc($result);
    } else {
      return null;
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

//   $sql = "INSERT INTO tf_personas (
//             id_persona,
//             nume_doc,
//             tipo_doc,
//             tipo_persona,
//             nombres,
//             ape_paterno,
//             ape_materno,
//             tipo_persona_juridica,
//             tipo_funcion,
//             razon_social
//           )
//           VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)
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
