<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";
require_once "./_CallApi.php";

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
  $anioActual = date("Y");
  $tipoFicha = "01";

  $numeroFicha = $dataPost['numeroFicha'];

  $departamento = $dataPost['ubigeo']['departamento'];
  $provincia = $dataPost['ubigeo']['provincia'];
  $distrito = $dataPost['ubigeo']['distrito'];
  $ubigeo = $departamento . $provincia . $distrito;

  $codigoSector = $dataPost["codigoReferenciaCatastral"]["codigoSector"];
  $codigoManzana = $dataPost["codigoReferenciaCatastral"]["codigoManzana"];
  $numeroManzana = $dataPost["ubicacionPredioCatastral"]["numeroManzana"];

  $codigoEdifica = $dataPost['codigoReferenciaCatastral']['codigoEdifica'];
  $codigoEntrada = $dataPost['codigoReferenciaCatastral']['codigoEntrada'];
  $codigoPiso = $dataPost['codigoReferenciaCatastral']['codigoPiso'];
  $codigoUnidad = $dataPost['codigoReferenciaCatastral']['codigoUnidad'];

  $tipoEdificacion = $dataPost['ubicacionPredioCatastral']['tipoEdificacion'];
  $tipoInterior = $dataPost['ubicacionPredioCatastral']['tipoInterior'];
  $lote = $dataPost['ubicacionPredioCatastral']['lote'];
  $subLote = $dataPost['ubicacionPredioCatastral']['subLote'];
  $habilitacionUrbana = $dataPost['ubicacionPredioCatastral']['habilitacionUrbana'];
  $grupoHU = $dataPost['ubicacionPredioCatastral']['grupoHU'];

  // registrar manzana
  $datosManzana = [
    "id_mzna" => trim($codigoSector . $codigoManzana),
    "id_sector" => trim($ubigeo . $codigoSector),
    "codi_mzna" => $codigoManzana,
    "nume_mzna" => $numeroManzana,
  ];

  $resultadoGuardarManzana = callApiPost('guardarManzana.php', $datosManzana);

  if (!$resultadoGuardarManzana["success"]) {
    return createResponse(false, null, 'Error registrando manzana');
  }

  $idMznaGuardado = $resultadoGuardarManzana["data"]['id_mzna'];

  // resgitrar lote
  $datosLote = [
    "id_lote" => trim($idMznaGuardado . $lote),
    "id_mzna" => $idMznaGuardado,
    "codi_lote" => $lote,
    "id_hab_urba" => trim($ubigeo . $habilitacionUrbana),
    "mzna_dist" => $numeroManzana,
    "lote_dist" => $lote,
    "sub_lote_dist" => $subLote,
    "estructuracion" => "",
    "zonificacion" => "",
    "cuc" => "",
    "zona_dist" => $grupoHU,
  ];

  $resultadoGuardarLote = callApiPost('guardarLote.php', $datosLote);

  if (!$resultadoGuardarLote["success"]) {
    return createResponse(false, null, 'Error registrando lote');
  }

  $idLoteGuardado = $resultadoGuardarLote["data"]['id_lote'];

  // registrar edificacion
  $datosEdificacion = [
    "id_edificacion" => trim($idLoteGuardado . $codigoEdifica),
    "id_lote" => $idLoteGuardado,
    "codi_edificacion" => $codigoEdifica,
    "tipo_edificacion" => $tipoEdificacion,
    "nomb_edificacion" => '',
    "clasificacion" => '',
  ];

  $resultadoGuardarEdificacion = callApiPost('guardarEdificacion.php', $datosEdificacion);

  if (!$resultadoGuardarEdificacion["success"]) {
    return createResponse(false, null, 'Error registrando edificacion');
  }

  $idEdificacionGuardado = $resultadoGuardarEdificacion['data']['id_edificacion'];

  $datosUniCat = [
    "id_uni_cat" => trim($codigoEdifica . $codigoEntrada . $codigoPiso . $codigoUnidad),
    "id_lote" => $idLoteGuardado,
    "id_edificacion" => $idEdificacionGuardado,
    "codi_entrada" => $codigoEntrada,
    "codi_piso" => $codigoPiso,
    "codi_unidad" => $codigoUnidad,
    "tipo_interior" => $tipoInterior,
    "cuc" => "",
    "cuc_antecedente" => "",
    "codi_hoja_catastral" => "",
    "codi_pred_rentas" => "",
    "nume_interior" => "",
    "unid_acum_rentas" => "",
    "codi_cont_rentas" => "",
  ];

  $resultadoGuardarUniCat = callApiPost('guardarUniCat.php', $datosUniCat);

  if (!$resultadoGuardarUniCat["success"]) {
    return createResponse(false, null, 'Error registrando uni cat');
  }

  $idUniCatGuardado = $resultadoGuardarUniCat['data']['id_uni_cat'];

  // registrar ficha
  $declarante = $dataPost['declarante'];
  $tecnico = $dataPost['tecnico'];
  $supervisor = $dataPost['supervisor'];
  $verificador = $dataPost['verificador'];

  $datosFicha = [
    "id_ficha" => trim($anioActual . $ubigeo . $tipoFicha + $numeroFicha),
    "tipo_ficha" => $tipoFicha,
    "nume_ficha" => $numeroFicha,
    "id_lote" => $idLoteGuardado,
    "dc" => "",
    "nume_ficha_lote" => "",
    "declarante" => $declarante['dni'],
    "fecha_declarante" => $declarante['fecha'],
    "supervisor" => $supervisor['dni'],
    "fecha_supervision" => $supervisor['fecha'],
    "tecnico" => $tecnico['dni'],
    "fecha_levantamiento" => $tecnico['fecha'],
    "verificador" => $verificador['dni'],
    "fecha_verificacion" => $verificador['fecha'],
    "nume_registro" => $verificador['numeroRegistro'],
    "id_uni_cat" => $idUniCatGuardado,
    'id_usuario' => '0218011',
    'fecha_grabado' => date("Y-m-d"),
    "activo" => "1"
  ];

  $resultadoGuardarFicha = callApiPost('guardarFicha.php', $datosFicha);

  if (!$resultadoGuardarFicha["success"]) {
    return createResponse(false, null, 'Error registrando ficha');

  }

  return createResponse(true, $resultadoGuardarFicha['data']);

  // $idFichaGuardado = $resultadoGuardarFicha['data']['id_ficha'];

  // // registrar ficha individual

  // $datosFichaIndividual = [
  //   "id_ficha" => $idFichaGuardado, // concatenación año+ubigeo+tipo+num ficha
  //   "codi_uso" => $dataPost['codi_uso'] ?? "",    // CHAR(6)
  //   "cont_en" => $dataPost['cont_en'] ?? "",     // CHAR(2)
  //   "clasificacion" => $dataPost['clasificacion'] ?? "", // CHAR(4)
  //   "area_titulo" => $dataPost['area_titulo'] ?? 0,  // NUMERIC(7,2)
  //   "area_declarada" => $dataPost['area_declarada'] ?? 0,
  //   "area_verificada" => $dataPost['area_verificada'] ?? 0,
  //   "porc_bc_terr_legal" => $dataPost['porc_bc_terr_legal'] ?? 0,
  //   "porc_bc_terr_ifsc" => $dataPost['porc_bc_terr_ifsc'] ?? 0,
  //   "porc_bc_const_legal" => $dataPost['porc_bc_const_legal'] ?? 0,
  //   "porc_bc_const_ifsc" => $dataPost['porc_bc_const_ifsc'] ?? 0,
  //   "evaluacion" => $dataPost['evaluacion'] ?? "",   // CHAR(2)
  //   "en_colindante" => $dataPost['en_colindante'] ?? 0,
  //   "en_jardin_aislamiento" => $dataPost['en_jardin_aislamiento'] ?? 0,
  //   "en_area_publica" => $dataPost['en_area_publica'] ?? 0,
  //   "en_area_intangible" => $dataPost['en_area_intangible'] ?? 0,
  //   "cond_declara" => $dataPost['cond_declara'] ?? "", // CHAR(2)
  //   "esta_llenado" => $dataPost['esta_llenado'] ?? "", // CHAR(1)
  //   "nume_habitantes" => $dataPost['nume_habitantes'] ?? 0,
  //   "nume_familias" => $dataPost['nume_familias'] ?? 0,
  //   "mantenimiento" => $dataPost['mantenimiento'] ?? "", // VARCHAR(50)
  //   "observaciones" => $dataPost['observaciones'] ?? "", // VARCHAR(500)
  //   "nume_ficha" => $numeroFicha
  // ];

  // $resultadoGuardarFichaIndividual = callApiPost('guardarFichaIndividual.php', $datosFichaIndividual);

  // if (!$resultadoGuardarFichaIndividual["success"]) {
  //   return createResponse(false, null, 'Error registrando ficha individual');
  // }

  // createResponse(true, $resultadoGuardarFichaIndividual["data"]);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
