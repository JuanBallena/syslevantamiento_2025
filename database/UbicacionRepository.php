<?php

class UbicacionRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarUbicacion(array $data): int
  {
    $sql = "INSERT INTO ext_fichas_ubicaciones (
      id_ficha,
      ubicacion
    ) VALUES ($1, $2)
    RETURNING *";

    $result = $this->db->insert($sql, $data);

    if (!$result || !isset($result['id_ficha'])) {
      throw new Exception("❌ Error al guardar fichas ubicaciones o no se obtuvo id_ficha.");
    }

    return $result['id_ficha'];
  }
}
