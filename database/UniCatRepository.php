<?php

class UniCatRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarUniCat(array $data): int
  {
    $sql = "INSERT INTO tf_uni_cat (
      id_uni_cat,
      id_lote,
      id_edificacion,
      codi_entrada,
      codi_piso,
      codi_unidad,
      tipo_interior,
      cuc,
      cuc_antecedente,
      codi_hoja_catastral,
      codi_pred_rentas,
      nume_interior,
      unid_acum_rentas,
      codi_cont_rentas
      ) VALUES (
          $1, $2, $3, $4, $5, $6, 
          $7, $8, $9, $10, $11, 
          $12, $13, $14
    ) RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_uni_cat'])) {
      throw new Exception("❌ Error al guardar uni cat o no se obtuvo id_uni_cat.");
    }

    return $result['id_uni_cat'];
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

//   $sql = "INSERT INTO tf_uni_cat (
//     id_uni_cat,
//     id_lote,
//     id_edificacion,
//     codi_entrada,
//     codi_piso,
//     codi_unidad,
//     tipo_interior,
//     cuc,
//     cuc_antecedente,
//     codi_hoja_catastral,
//     codi_pred_rentas,
//     nume_interior,
//     unid_acum_rentas,
//     codi_cont_rentas
//     ) VALUES (
//         $1, $2, $3, $4, $5, $6,
//         $7, $8, $9, $10, $11,
//         $12, $13, $14
//   ) RETURNING *";

//   $registro = $BD->insert($sql, $input);

//   createResponse(true, $registro);

// } catch (Exception $e) {
//   createResponse(false, [], $e->getMessage());
// } finally {
//   if (isset($BD)) {
//     $BD->desconectar();
//   }
// }
