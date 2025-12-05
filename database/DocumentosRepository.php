<?php

class DocumentosRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  /**
   * Inserta múltiples documentos adjuntos
   * @param array $lista Array de arrays, cada uno con:
   *  id_doc, id_ficha, codi_doc, tipo_doc, nume_doc, area_autorizada, fecha_doc
   */
  public function guardarVariosDocumentos(array $lista): array
  {
    if (!is_array($lista) || empty($lista)) {
      throw new Exception("❌ No se recibieron documentos válidos para insertar.");
    }

    $placeholders = [];
    $params = [];
    $count = 1;

    foreach ($lista as $fila) {

      // Validación básica
      if (!isset(
        $fila['id_doc'],
        $fila['id_ficha'],
        $fila['codi_doc'],
        $fila['tipo_doc'],
        $fila['nume_doc'],
        $fila['area_autorizada'],
        $fila['fecha_doc']
      )) {
        throw new Exception("❌ Falta un campo obligatorio en un documento adjunto.");
      }

      // Construcción de placeholders dinámicos
      $placeholders[] = "("
        . "$" . ($count++) . ", "
        . "$" . ($count++) . ", "
        . "$" . ($count++) . ", "
        . "$" . ($count++) . ", "
        . "$" . ($count++) . ", "
        . "$" . ($count++) . ", "
        . "$" . ($count++) . ")";

      // Push de valores
      array_push(
        $params,
        $fila['id_doc'],
        $fila['id_ficha'],
        $fila['codi_doc'],
        $fila['tipo_doc'],
        $fila['nume_doc'],
        $fila['area_autorizada'],
        $fila['fecha_doc']
      );
    }

    // SQL dinámico
    $sql = "INSERT INTO tf_documentos_adjuntos (
              id_doc,
              id_ficha,
              codi_doc,
              tipo_doc,
              nume_doc,
              area_autorizada,
              fecha_doc
            )
            VALUES " . implode(", ", $placeholders) . "
            RETURNING *";

    // Ejecutar
    $result = $this->db->insert($sql, $params);

    if (!$result) {
      throw new Exception("❌ Error al insertar documentos adjuntos.");
    }

    return $result;
  }
}
