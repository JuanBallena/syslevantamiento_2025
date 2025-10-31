<?php

header('Content-Type: application/json; charset=UTF-8');

try {
  if (!isset($_FILES['archivos'])) {
    throw new Exception("No se enviaron archivos");
  }

  $idFicha = $_POST['id_ficha'] ?? null;

  $archivos = $_FILES['archivos'];
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
        "nombre_original" => $nombreOriginal,
        "tipo" => $tipo,
        "url" => $urlArchivo
      ];
    }
  }

  if (empty($urls)) {
    throw new Exception("No se pudo subir ningún archivo");
  }

  echo json_encode([
    "success" => true,
    "total" => count($urls),
    "archivos" => $urls
  ]);

} catch (Exception $e) {
  echo json_encode([
    "success" => false,
    "error" => $e->getMessage()
  ]);
}
