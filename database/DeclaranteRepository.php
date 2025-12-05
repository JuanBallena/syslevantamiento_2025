<?php

class DeclaranteRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarDeclarante(array $data): int
  {
    $sql = "INSERT INTO ext_declarantes (
            dni,
            nombres,
            ape_paterno,
            ape_materno,
            fecha,
            id_ficha
          )
          VALUES ($1, $2, $3, $4, $5, $6)
          RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_ficha'])) {
      throw new Exception("❌ Error al declarante lote o no se obtuvo id_ficha.");
    }

    return $result['id_ficha'];
  }
}
