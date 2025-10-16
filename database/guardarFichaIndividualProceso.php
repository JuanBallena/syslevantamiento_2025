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

  // return createResponse(true, $dataPost);

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
  $nombreHU = $dataPost['ubicacionPredioCatastral']['nombreHU'];
  $codigoHU = $dataPost['ubicacionPredioCatastral']['codigoHU'];
  $grupoHU = $dataPost['ubicacionPredioCatastral']['grupoHU'];

  // Guardar manzana
  $datosManzana = [
    "id_mzna" => trim($codigoSector . $codigoManzana),
    "id_sector" => trim($codigoSector),
    "codi_mzna" => $codigoManzana,
    "nume_mzna" => $numeroManzana,
  ];

  $resultadoGuardarManzana = callApiPost('guardarManzana.php', $datosManzana);

  if (!$resultadoGuardarManzana["success"]) {
    return createResponse(false, null, 'Error registrando manzana');
  }

  $idMznaGuardado = $resultadoGuardarManzana["data"]['id_mzna'];

  //Guardar HU
  $datosHU = [
    "id_hab_urba" => trim($ubigeo . $codigoHU),
    "grup_urba" => $grupoHU,
    "tipo_hab_urba" => '',
    "nomb_hab_urba" => $nombreHU,
    "codi_hab_urba" => $codigoHU,
    "id_ubi_geo" => $ubigeo,
  ];

  $resultadoGuardarHU = callApiPost('guardarHU.php', $datosHU);

  if (!$resultadoGuardarHU["success"]) {
    return createResponse(false, null, 'Error registrando HU');
  }

  $idHUGuardado = $resultadoGuardarHU["data"]['id_hab_urba'];

  // Guardar lote
  $datosLote = [
    "id_lote" => trim($idMznaGuardado . $lote),
    "id_mzna" => $idMznaGuardado,
    "codi_lote" => $lote,
    "id_hab_urba" => trim($idHUGuardado),
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

  // Guardar edificacion
  $datosEdificacion = [
    "id_edificacion" => trim($idLoteGuardado . $codigoEdifica),
    "id_lote" => trim($idLoteGuardado),
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

  // Guardar Uni cat
  $datosUniCat = [
    "id_uni_cat" => trim($codigoEdifica . $codigoEntrada . $codigoPiso . $codigoUnidad),
    "id_lote" => trim($idLoteGuardado),
    "id_edificacion" => trim($idEdificacionGuardado),
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

  // Guardar ficha
  $datosFicha = [
    "id_ficha" => trim($anioActual . $ubigeo . $tipoFicha + $numeroFicha),
    "tipo_ficha" => $tipoFicha,
    "nume_ficha" => $numeroFicha,
    "id_lote" => trim($idLoteGuardado),
    "dc" => "",
    "nume_ficha_lote" => "",
    "declarante" => $dataPost['declarante']['dni'],
    "fecha_declarante" => $dataPost['declarante']['fecha'],
    "supervisor" => $dataPost['supervisor']['dni'],
    "fecha_supervision" => $dataPost['supervisor']['fecha'],
    "tecnico" => $dataPost['tecnico']['dni'],
    "fecha_levantamiento" => $dataPost['tecnico']['fecha'],
    "verificador" => $dataPost['verificador']['dni'],
    "fecha_verificacion" => $dataPost['verificador']['fecha'],
    "nume_registro" => $dataPost['verificador']['numeroRegistro'],
    "id_uni_cat" => $idUniCatGuardado,
    'id_usuario' => '0218011',
    'fecha_grabado' => date("Y-m-d"),
    "activo" => "1"
  ];

  $resultadoGuardarFicha = callApiPost('guardarFicha.php', $datosFicha);

  if (!$resultadoGuardarFicha["success"]) {
    return createResponse(false, null, 'Error registrando ficha');
  }

  $idFichaGuardado = $resultadoGuardarFicha['data']['id_ficha'];

  // Guardar ficha individual
  $datosFichaIndividual = [
    "id_ficha" => trim($idFichaGuardado),
    "codi_uso" => $dataPost['descripcionPredio']['uso'],
    "cont_en" => "",
    "clasificacion" => $dataPost['descripcionPredio']['clasificacionPredio'],
    "area_titulo" => $dataPost['descripcionPredio']['areaTerrenoAdquirida'],
    "area_declarada" => 0,
    "area_verificada" => $dataPost['descripcionPredio']['areaTerrenoVerificada'],
    "porc_bc_terr_legal" => 0,
    "porc_bc_terr_fisc" => 0,
    "porc_bc_const_legal" => 0,
    "porc_bc_const_fisc" => 0,
    "evaluacion" => '',
    "en_colindante" => $dataPost['evaluacionPredio']['enColindante'] ?? 0,
    "en_jardin_aislamiento" => $dataPost['evaluacionPredio']['enJardinAislamiento'] ?? 0,
    "en_area_publica" => $dataPost['evaluacionPredio']['enAreaPublica'] ?? 0,
    "en_area_intangible" => $dataPost['evaluacionPredio']['enAreaIntangible'] ?? 0,
    "cond_declarante" => $dataPost['informacionComplementaria']['condicionDeclarante'],
    "esta_llenado" => $dataPost['informacionComplementaria']['estadoFicha'],
    "nume_habitantes" => $dataPost['informacionComplementaria']['numeroHabitantes'],
    "nume_familias" => $dataPost['informacionComplementaria']['numeroFamilias'],
    "mantenimiento" => $dataPost['informacionComplementaria']['mantenimiento'],
    "observaciones" => $dataPost['observaciones']['texto'],
    "nume_ficha" => $numeroFicha
  ];

  $resultadoGuardarFichaIndividual = callApiPost('guardarFichaIndividual.php', $datosFichaIndividual);

  // guardar vias
  $vias = $dataPost['puertasPredioCatastral'];

  foreach ($vias as $via) {

    // $datosVia = [
    //   'id_via' => trim($ubigeo . $via['codigo']),
    //   'nomb_via' => $via['nombre'],
    //   'tipo_via' => $via['tipo'],
    //   'codi_via' => $via['codigo'],
    //   'id_ubi_geo' => trim($ubigeo),
    //   'fecha_via' => '2025-10-16',
    // ];

    // $resultadoGuardarVia = callApiPost('guardarVia.php', $datosVia);

    // if (!$resultadoGuardarVia["success"]) {
    //   return createResponse(false, null, 'Error registrando via');
    // }

    // $idViaGuardado = $resultadoGuardarVia['data']['id_via'];

    $datosPuertas = [];

    foreach ($via['puertas'] as $puerta) {
      $datosPuerta = [
        'id_puerta' => trim($idLoteGuardado . $puerta['codigo']),
        'id_lote' => trim($idLoteGuardado),
        'codi_puerta' => $puerta['codigo'],
        'tipo_puerta' => $puerta['tipo'],
        'nume_muni' => $puerta['numeroMunicipal'],
        'cond_nume' => '',
        'id_via' => trim($via['idVia']),
        'nume_certificacion' => ''
      ];

      array_push($datosPuertas, $datosPuerta);
    }

    $puertasGuardadas = callApiPost('guardarPuertas.php', $datosPuertas);

    if (!$resultadoGuardarVia["success"]) {
      return createResponse(false, null, 'Error registrando puertas');
    }
  }

  // Guardar servicios
  $datosServicios = [
    'id_ficha' => trim($idFichaGuardado),
    'luz' => $dataPost['serviciosBasicos']['luz'],
    'agua' => $dataPost['serviciosBasicos']['agua'],
    'telefono' => $dataPost['serviciosBasicos']['telefono'],
    'desague' => $dataPost['serviciosBasicos']['desague'],
    'nume_sum_luz' => '',
    'nume_telefono' => '',
    'nume_contrato_agua' => '',
  ];

  $resultadoGuardarServicios = callApiPost('guardarServicios.php', $datosServicios);

  // Guardar construcciones
  $datosConstrucciones = [];

  foreach ($dataPost['construcciones'] as $construccion) {
    $datosConstruccion = [
      'id_construccion' => $idFichaGuardado,
      'id_ficha' => $idFichaGuardado,
      'codi_construccion' => '1',
      'nume_piso' => $construccion['numero_piso'],
      'fecha' => $construccion['fecha'],
      'mep' => $construccion['mep'],
      'ecs' => $construccion['ecs'],
      'ecc' => $construccion['ecc'],
      'estr_muro_col' => $construccion['muros_columnas'],
      'estr_techo' => $construccion['techos'],
      'acab_piso' => $construccion['pisos'],
      'acab_puerta_ven' => $construccion['puertas_ventanas'],
      'acab_revest' => '',
      'acab_bano' => '',
      'inst_elect_sanita' => '',
      'area_declarada' => $construccion['area_verificada'], //cambiar
      'area_verificada' => $construccion['area_verificada'],
      'uca' => ''
    ];

    array_push($datosConstrucciones, $datosConstruccion);
  }

  $resultadoGuardarConstrucciones = callApiPost('guardarConstrucciones.php', $datosConstrucciones);

  // Guardar linderos

  $datosLindero = [
    'id_ficha' => $idFichaGuardado,
    'fren_campo' => $dataPost['descripcionPredio']['linderos'][0]['medida'],
    'fren_titulo' => '',
    'fren_colinda_campo' => $dataPost['descripcionPredio']['linderos'][0]['colindancia'],
    'fren_colinda_titulo' => '',
    'dere_campo' => $dataPost['descripcionPredio']['linderos'][1]['medida'],
    'dere_titulo' => '',
    'dere_colinda_campo' => $dataPost['descripcionPredio']['linderos'][1]['medida'],
    'dere_colinda_titulo' => '',
    'izqu_campo' => $dataPost['descripcionPredio']['linderos'][2]['medida'],
    'izqu_titulo' => '',
    'izqu_colinda_campo' => $dataPost['descripcionPredio']['linderos'][2]['medida'],
    'izqu_colinda_titulo' => '',
    'fond_campo' => $dataPost['descripcionPredio']['linderos'][3]['medida'],
    'fond_titulo' => '',
    'fond_colinda_campo' => $dataPost['descripcionPredio']['linderos'][3]['medida'],
    'fond_colinda_titulo' => ''
  ];

  $resultadoGuardarLinderos = callApiPost('guardarLindero.php', $datosLindero);

  // Respuesta
  if (!$resultadoGuardarFichaIndividual["success"]) {
    return createResponse(false, null, 'Error registrando ficha individual');
  }

  createResponse(true, $resultadoGuardarFichaIndividual["data"]);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
