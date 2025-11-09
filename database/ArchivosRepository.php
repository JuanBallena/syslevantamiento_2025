<?php

class ArchivosRepository
{
  private $db; // Instancia de DBPostgres

  public function __construct(DBPostgres $dbInstance)
  {
    $this->db = $dbInstance;
  }

  public function guardarArchivos($idFicha, $archivos)
  {
    $totalArchivos = count($archivos['name']);
    $urls = [];

    for ($i = 0; $i < $totalArchivos; $i++) {
      if ($archivos['error'][$i] !== UPLOAD_ERR_OK) {
        continue;
      }

      $nombreOriginal = basename($archivos['name'][$i]);
      $tmpName = $archivos['tmp_name'][$i];
      $tipo = mime_content_type($tmpName);
      $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);

      // Elegir carpeta destino según tipo
      $carpetaDestino = __DIR__ . '/../public/uploads/';
      if (str_starts_with($tipo, 'image/')) {
        $carpetaDestino .= 'images/';
      } elseif ($tipo === 'application/pdf') {
        $carpetaDestino .= 'pdf/';
      } else {
        $carpetaDestino .= 'otros/';
      }

      if (!file_exists($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
      }

      $nombreGuardado = uniqid() . '.' . $extension;
      $rutaFinal = $carpetaDestino . $nombreGuardado;

      if (move_uploaded_file($tmpName, $rutaFinal)) {
        $urlBase = "http://localhost/mi_proyecto/public/uploads/";
        if (str_starts_with($tipo, 'image/')) {
          $urlArchivo = $urlBase . "images/" . $nombreGuardado;
        } elseif ($tipo === 'application/pdf') {
          $urlArchivo = $urlBase . "pdf/" . $nombreGuardado;
        } else {
          $urlArchivo = $urlBase . "otros/" . $nombreGuardado;
        }
        $urls[] = [
          "id_ficha" => $idFicha,
          "nombre_archivo" => $nombreOriginal,
          "ruta_archivo" => $urlArchivo
        ];
      }
    }

    if (empty($urls)) {
      throw new Exception("No se pudo subir ningún archivo");
    }

    $this->guardarUrlsEnBaseDatos($urls);
  }

  public function guardarUrlsEnBaseDatos(array $urls)
  {
    $placeholders = [];
    $params = [];
    $count = 1;

    foreach ($urls as $fila) {
      $placeholders[] = "($" . ($count++) . ", $" . ($count++) . ", $" . ($count++) . ")";

      array_push(
        $params,
        $fila['id_ficha'] ?? null,
        $fila['nombre_archivo'] ?? null,
        $fila['ruta_archivo'] ?? null
      );
    }

    $sql = "
    INSERT INTO ext_archivos (id_ficha, nombre_archivo, ruta_archivo)
    VALUES " . implode(", ", $placeholders) . "
    RETURNING *;
  ";

    $result = $this->db->insert($sql, $params);
  }
}
