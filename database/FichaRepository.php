<?php

class FichaRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarFicha(array $data): int
  {
    $sql = "INSERT INTO tf_fichas (
        id_ficha,
        tipo_ficha,
        nume_ficha,
        id_lote,
        dc,
        nume_ficha_lote,
        declarante,
        fecha_declarante,
        supervisor,
        fecha_supervision,
        tecnico,
        fecha_levantamiento,
        verificador,
        fecha_verificacion,
        nume_registro,
        id_uni_cat,
        id_usuario,
        fecha_grabado,
        activo
    ) VALUES (
        $1, $2, $3, $4, $5, 
        $6, $7, $8, $9, $10, 
        $11, $12, $13, $14, $15, 
        $16, $17, $18, $19
    )
    RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_ficha'])) {
      throw new Exception("❌ Error al guardar ficha o no se obtuvo id_ficha.");
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

//   $sql = "INSERT INTO tf_fichas (
//             id_ficha,
//             tipo_ficha,
//             nume_ficha,
//             id_lote,
//             dc,
//             nume_ficha_lote,
//             declarante,
//             fecha_declarante,
//             supervisor,
//             fecha_supervision,
//             tecnico,
//             fecha_levantamiento,
//             verificador,
//             fecha_verificacion,
//             nume_registro,
//             id_uni_cat,
//             id_usuario,
//             fecha_grabado,
//             activo
//         ) VALUES (
//             $1, $2, $3, $4, $5,
//             $6, $7, $8, $9, $10,
//             $11, $12, $13, $14, $15,
//             $16, $17, $18, $19
//         )
//         RETURNING *";

//   $registro = $BD->insert($sql, $input);

//   createResponse(true, $registro);

// } catch (Exception $e) {
//   createResponse(false, [], $e->getMessage());
// } finally {
//   if (isset($BD)) {
//     $BD->desconectar();
//   }
// }
