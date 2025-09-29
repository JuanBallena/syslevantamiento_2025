<?php

// require_once './inserts/InsertSectorTable.php';
// require_once './inserts/InsertManzanaTable.php';
// require_once './inserts/InsertConstruccionTable.php';
// require_once './inserts/InsertFichaTable.php';
// require_once './inserts/InsertInformacionComplementariaTable.php';
// require_once './inserts/InsertLoteTable.php';
// require_once './inserts/InsertServiciosBasicosTable.php';
// require_once './inserts/InsertUniCatTable.php';
// require_once './inserts/InsertPuertaTable.php';
// require_once './model/database_catastro.php';

// ini_set('display_errors', 0);
// error_reporting(E_ERROR | E_PARSE);

header("Content-Type: application/json; charset=UTF-8");

try {
  if (!isset($_POST['dataPost'])) {
    throw new Exception("No se recibieron datos");
  }

  $dataPost = json_decode($_POST['dataPost'], true);
  if (!$dataPost) {
    throw new Exception("Error decodificando JSON");
  }

  // file_put_contents("debug.json", json_encode($dataPost, JSON_PRETTY_PRINT));

  // // === IDs principales ===

  $ubigeo = $dataPost['ubigeo']['departamento'] . $dataPost['ubigeo']['provincia'] . $dataPost['ubigeo']['distrito'];
  $codRef = $dataPost['codigoReferenciaCatastral'];
  $idSector = $ubigeo . $codRef['sector'];
  $idManzana = $idSector . $codRef['manzana'];
  $idLote = $idManzana . $codRef['lote'];
  $idUniCat = $idLote . $codRef['edifica'] . $codRef['entrada'] . $codRef['piso'] . $codRef['unidad'];
  $idFicha = $idUniCat;

  // === Insert Sector ===
  $insertSectorTable = new InsertSectorTable();
  $insertSectorTable->insert(
    $idSector,
    $ubigeo,
    $codRef['lote']
  );

  // === Insert Manzana ===
  $insertManzanaTable = new InsertManzanaTable();
  $insertManzanaTable->insert(
    $idManzana,
    $codRef['manzana'],
    $idSector,
    $dataPost['ubicacionPredioCatastral']['manzana']
  );

  // === Insert Lote ===
  $insertLoteTable = new InsertLoteTable();
  $insertLoteTable->insert(
    $idLote,
    $idManzana,
    $codRef['lote'],
    $dataPost['descripcionPredio']['uso'],
    $dataPost['ubicacionPredioCatastral']['manzana'],
    $dataPost['ubicacionPredioCatastral']['lote'],
    $dataPost['ubicacionPredioCatastral']['subLote']
  );

  // === Insert Unidad Catastral ===
  $insertUniCatTable = new InsertUniCatTable();
  $insertUniCatTable->insert(
    $idUniCat,
    $idLote,
    $codRef['entrada'],
    $codRef['piso'],
    $codRef['unidad'],
    $codRef['edifica']
  );

  // === Servicios Básicos ===
  $serv = $dataPost['serviciosBasicos'];
  $insertServiciosBasicosTable = new InsertServiciosBasicosTable();
  $insertServiciosBasicosTable->insert(
    $idFicha,
    !empty($serv['luz']) ? 1 : 0,
    !empty($serv['agua']) ? 1 : 0,
    !empty($serv['telefono']) ? 1 : 0,
    !empty($serv['desague']) ? 1 : 0,
    !empty($serv['gas']) ? 1 : 0
  );

  // === Construcciones ===
  foreach ($dataPost['construcciones'] as $idx => $cons) {
    $insertConstruccionTable = new InsertConstruccionTable();
    $insertConstruccionTable->insert(
      $idFicha . ($idx + 1),
      $idFicha,
      $cons['nroPiso'] ?? null,
      $cons['codWallandColumns'] ?? null,
      $cons['codCeiling'] ?? null,
      $cons['codFloors'] ?? null,
      $cons['codDoorandWindow'] ?? null,
      $cons['codMaterial'] ?? null
    );
  }

  // === Información complementaria ===
  $info = $dataPost['informacionComplementaria'];
  $insertInformacionComplementariaTable = new InsertInformacionComplementariaTable();
  $insertInformacionComplementariaTable->insert(
    $idFicha,
    $info['cantidadMedidores'] ?? 0,
    $dataPost['observaciones']['text'] ?? '',
    !empty($info['posiblesUnidades']['subdivision']) ? 1 : 0,
    !empty($info['posiblesUnidades']['acumulacion']) ? 1 : 0,
    !empty($info['posiblesUnidades']['independizacion']) ? 1 : 0
  );

  // === Imagen ===
  $ruta_imagen = null;
  if (!empty($_FILES['file']['tmp_name'])) {
    $path = $_FILES['file']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nombre_archivo = $idUniCat;
    $ruta_imagen = './imagenes/' . $nombre_archivo . '.' . $ext;
    move_uploaded_file($_FILES['file']['tmp_name'], $ruta_imagen);
  }

  // === Insert Ficha Principal ===
  $insertFichaTable = new InsertFichaTable();
  $insertFichaTable->insert(
    $idUniCat, // 1
    $idSector, // 2
    $dataPost['ubicacionPredioCatastral']['manzana'], // 3
    $dataPost['ubicacionPredioCatastral']['lote'], // 4
    $dataPost['ubicacionPredioCatastral']['subLote'], // 5
    $dataPost['ubigeo']['departamento'], // 6
    $dataPost['ubigeo']['provincia'], // 7
    $dataPost['ubigeo']['distrito'], // 8
    $idFicha, // 9
    $ruta_imagen, // 10
    $dataPost['descripcionPredio']['uso'] ?? null, // 11
    $dataPost['descripcionPredio']['area'] ?? null, // 12
    $dataPost['descripcionPredio']['perimetro'] ?? null, // 13
    $dataPost['descripcionPredio']['frente'] ?? null, // 14
    $dataPost['descripcionPredio']['fondo'] ?? null, // 15
    $dataPost['descripcionPredio']['lateralDerecho'] ?? null, // 16
    $dataPost['descripcionPredio']['lateralIzquierdo'] ?? null, // 17
    $dataPost['descripcionPredio']['coordenadaX'] ?? null, // 18
    $dataPost['descripcionPredio']['coordenadaY'] ?? null, // 19
    $dataPost['descripcionPredio']['altitud'] ?? null // 20
  );

  // === Puertas del predio ===
  foreach ($dataPost['puertasPredioCatastral'] as $via) {
    foreach ($via['puertas'] as $puerta) {
      $insertPuertaTable = new InsertPuertaTable();
      $insertPuertaTable->insert(
        $idLote . $puerta['tipo'] . $via['tipoViaId'],
        $idLote,
        $puerta['tipo'],
        $puerta['numero'],
        $via['tipoViaId'],
        $idFicha,
        $via['viaId'],
        $ubigeo . $via['viaId'],
        $via['id']
      );
    }
  }

  // echo json_encode(["success" => true]);
} catch (Exception $e) {
  echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
