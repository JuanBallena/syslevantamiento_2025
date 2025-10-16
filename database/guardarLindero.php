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

  $sql = "INSERT INTO tf_linderos (
            id_ficha,
            fren_campo,
            fren_titulo,
            fren_colinda_campo,
            fren_colinda_titulo,
            dere_campo,
            dere_titulo,
            dere_colinda_campo,
            dere_colinda_titulo,
            izqu_campo,
            izqu_titulo,
            izqu_colinda_campo,
            izqu_colinda_titulo,
            fond_campo,
            fond_titulo,
            fond_colinda_campo,
            fond_colinda_titulo
          )
          VALUES (
            $1, $2, $3, $4, $5,
            $6, $7, $8, $9, $10,
            $11, $12, $13, $14, $15,
            $16, $17
          )
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
