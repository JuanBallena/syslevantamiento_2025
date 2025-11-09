<?php

class FichaIndividualRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarFichaIndividual(array $data): int
  {
    $sql = "INSERT INTO tf_fichas_individuales (
        id_ficha,
        codi_uso,
        cont_en,
        clasificacion,
        area_titulo,
        area_declarada,
        area_verificada,
        porc_bc_terr_legal,
        porc_bc_terr_fisc,
        porc_bc_const_legal,
        porc_bc_const_fisc,
        evaluacion,
        en_colindante,
        en_jardin_aislamiento,
        en_area_publica,
        en_area_intangible,
        cond_declarante,
        esta_llenado,
        nume_habitantes,
        nume_familias,
        mantenimiento,
        observaciones,
        nume_ficha
    ) VALUES (
        $1, $2, $3, $4, $5, 
        $6, $7, $8, $9, $10, 
        $11, $12, $13, $14, $15, 
        $16, $17, $18, $19, $20, 
        $21, $22, $23
    )
    RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_ficha'])) {
      throw new Exception("❌ Error al guardar ficha individual o no se obtuvo id_ficha.");
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

//   $sql = "INSERT INTO tf_fichas_individuales (
//       id_ficha,
//       codi_uso,
//       cont_en,
//       clasificacion,
//       area_titulo,
//       area_declarada,
//       area_verificada,
//       porc_bc_terr_legal,
//       porc_bc_terr_fisc,
//       porc_bc_const_legal,
//       porc_bc_const_fisc,
//       evaluacion,
//       en_colindante,
//       en_jardin_aislamiento,
//       en_area_publica,
//       en_area_intangible,
//       cond_declarante,
//       esta_llenado,
//       nume_habitantes,
//       nume_familias,
//       mantenimiento,
//       observaciones,
//       nume_ficha
//   ) VALUES (
//       $1, $2, $3, $4, $5,
//       $6, $7, $8, $9, $10,
//       $11, $12, $13, $14, $15,
//       $16, $17, $18, $19, $20,
//       $21, $22, $23
//   )
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
