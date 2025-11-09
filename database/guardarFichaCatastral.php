<?php

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";
require_once "./_CallApi.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");

try {
  if (!isset($_POST['dataPost'])) {
    throw new Exception("No se recibieron datos");
  }

  $dataPost = json_decode($_POST['dataPost'], true);

  if (!$dataPost) {
    throw new Exception("Error decodificando JSON");
  }

  // return createResponse(true, $dataPost['puertasPredioCatastral']);

  $anioActual = date("Y");
  $tipoFicha = "01";

  $numeroFicha = $dataPost['numeroFicha'];

  $departamento = $dataPost['ubigeo']['departamento'];
  $provincia = $dataPost['ubigeo']['provincia'];
  $distrito = $dataPost['ubigeo']['distrito'];
  $ubigeo = $departamento . $provincia . $distrito;

  $idSector = $dataPost["codigoReferenciaCatastral"]["idSector"];
  $idManzana = $dataPost["codigoReferenciaCatastral"]["idManzana"];
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
  $idHU = $dataPost['ubicacionPredioCatastral']['idHU'];

  // Guardar lote
  $datosLote = [
    "id_lote" => trim($idManzana . $lote),
    "id_mzna" => $idManzana,
    "codi_lote" => $lote,
    "id_hab_urba" => trim($idHU),
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
    "id_ficha" => trim($anioActual . $ubigeo . $tipoFicha . $numeroFicha),
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
    'id_usuario' => '0218011', // POR REVISAR
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
    "clasificacion" => $dataPost['descripcionPredio']['clasificacionPredio'] ?? '',
    "area_titulo" => $dataPost['descripcionPredio']['areaTerrenoAdquirida'] ?? 0,
    "area_declarada" => 0,
    "area_verificada" => $dataPost['descripcionPredio']['areaTerrenoVerificada'] ?? 0,
    "porc_bc_terr_legal" => 0,
    "porc_bc_terr_fisc" => 0,
    "porc_bc_const_legal" => 0,
    "porc_bc_const_fisc" => 0,
    "evaluacion" => '',
    "en_colindante" => $dataPost['evaluacionPredio']['enColindante'] ?? 0,
    "en_jardin_aislamiento" => $dataPost['evaluacionPredio']['enJardinAislamiento'] ?? 0,
    "en_area_publica" => $dataPost['evaluacionPredio']['enAreaPublica'] ?? 0,
    "en_area_intangible" => $dataPost['evaluacionPredio']['enAreaIntangible'] ?? 0,
    "cond_declarante" => $dataPost['informacionComplementaria']['condicionDeclarante'] ?? '',
    "esta_llenado" => $dataPost['informacionComplementaria']['estadoFicha'] ?? '',
    "nume_habitantes" => $dataPost['informacionComplementaria']['numeroHabitantes'] ?? 0,
    "nume_familias" => $dataPost['informacionComplementaria']['numeroFamilias'] ?? 0,
    "mantenimiento" => $dataPost['informacionComplementaria']['mantenimiento'] ?? '',
    "observaciones" => $dataPost['observaciones']['texto'] ?? '',
    "nume_ficha" => $numeroFicha
  ];

  $resultadoGuardarFichaIndividual = callApiPost('guardarFichaIndividual.php', $datosFichaIndividual);

  if (!$resultadoGuardarFichaIndividual["success"]) {
    return createResponse(false, null, 'Error registrando ficha individual');
  }

  // Guardar declarante
  $datosDeclarante = [
    "dni" => $dataPost['declarante']['dni'],
    "nombres" => $dataPost['declarante']['nombres'] ?? '',
    "ape_paterno" => $dataPost['declarante']['apellidoPaterno'] ?? '',
    "ape_materno" => $dataPost['declarante']['apellidoMaterno'] ?? '',
    "fecha" => $dataPost['declarante']['fecha'],
    "id_ficha" => $idFichaGuardado,
  ];

  $resultadoGuardarDeclarante = callApiPost('guardarDeclarante.php', $datosDeclarante);

  if (!$resultadoGuardarDeclarante["success"]) {
    return createResponse(false, null, 'Error registrando declarante');
  }

  // Guardar sunarp
  $fechaInscripcion = !empty($dataPost['inscripcionPredioCatastral']['fechaInscripcion'])
    ? $dataPost['inscripcionPredioCatastral']['fechaInscripcion']
    : null;

  $fechaFabrica = !empty($dataPost['inscripcionPredioCatastral']['fechaFabrica'])
    ? $dataPost['inscripcionPredioCatastral']['fechaFabrica']
    : null;

  $datosSunarp = [
    "id_ficha" => $idFichaGuardado,
    "tipo_partida" => $dataPost['inscripcionPredioCatastral']['tipoPartida'] ?? '',
    "nume_partida" => $dataPost['inscripcionPredioCatastral']['numeroPartida'] ?? '',
    "fojas" => $dataPost['inscripcionPredioCatastral']['fojas'] ?? '',
    "asiento" => $dataPost['inscripcionPredioCatastral']['asiento'] ?? '',
    "fecha_inscripcion" => $fechaInscripcion,
    "codi_decla_fabrica" => $dataPost['inscripcionPredioCatastral']['codigoDeclaracionFabrica'] ?? '',
    "asie_fabrica" => $dataPost['inscripcionPredioCatastral']['asientoFabrica'] ?? '',
    "fecha_fabrica" => $fechaFabrica,
  ];

  $resultadoGuardarSunarp = callApiPost('guardarSunarp.php', $datosSunarp);

  if (!$resultadoGuardarSunarp["success"]) {
    return createResponse(false, null, 'Error registrando sunarp');
  }

  // Guardar titulares y domicilio titulares
  $datosTitulares = [];
  $datosDomicilioTitulares = [];

  if (count($dataPost['identificacionTitularCatastral']['personasNaturales']) > 0) {

    foreach ($dataPost['identificacionTitularCatastral']['personasNaturales'] as $personaNatural) {

      $idPersona = $personaNatural['tipo']
      . $personaNatural['tipoDocumento']
      . $personaNatural['numeroDocumento'];

      $datosPersona = [
        "id_persona" => $idPersona,
        "nume_doc" => $personaNatural['numeroDocumento'],
        "tipo_doc" => $personaNatural['tipoDocumento'],
        "tipo_persona" => $personaNatural['tipo'],
        "nombres" => $personaNatural['nombres'],
        "ape_paterno" => $personaNatural['apellidoPaterno'],
        "ape_materno" => $personaNatural['apellidoMaterno'],
        "tipo_persona_juridica" => '',
        "tipo_funcion" => '',
        "razon_social" => '',
      ];

      // Guardar Persona Natural
      $resultadoGuardarPersona = callApiPost('guardarPersona.php', $datosPersona);

      if (!$resultadoGuardarPersona["success"]) {
        return createResponse(false, null, 'Error registrando persona');
      }

      $idPersonaGuardado = $resultadoGuardarPersona['data']['id_persona'];

      array_push($datosTitulares, [
        "id_ficha" => $idFichaGuardado,
        "id_persona" => trim($idPersonaGuardado),
        "form_adquisicion" => $personaNatural['caracteristicas']['formaAdquisicion'],
        "fecha_adquisicion" => $personaNatural['caracteristicas']['fechaAdquisicion'],
        "porc_cotitular" => '0.0',
        "esta_civil" => $personaNatural['estadoCivil'],
        "fax" => '',
        "telf" => $personaNatural['domicilio']['telefono'],
        "anexo" => $personaNatural['domicilio']['anexo'],
        "email" => $personaNatural['domicilio']['correo'],
        "nume_titular" => '',
        "codi_contribuyente" => '',
        "cond_titular" => $personaNatural['caracteristicas']['condicionTitular']
      ]);

      array_push($datosDomicilioTitulares, [
        "id_ficha" => $idFichaGuardado,
        "id_persona" => trim($idPersonaGuardado),
        "codi_via" => trim($personaNatural['domicilio']['codigoVia']),
        "tipo_via" => $personaNatural['domicilio']['tipoVia'],
        "nomb_via" => $personaNatural['domicilio']['nombreVia'],
        "nume_muni" => $personaNatural['domicilio']['numeroMunicipal'],
        "nomb_edificacion" => '',
        "nume_interior" => $personaNatural['domicilio']['numeroInterior'],
        "codi_hab_urba" => $personaNatural['domicilio']['codigoHU'],
        "nomb_hab_urba" => $personaNatural['domicilio']['nombreHU'],
        "sector" => $personaNatural['domicilio']['zonaSectorEtapa'],
        "mzna" => $personaNatural['domicilio']['manzana'],
        "lote" => $personaNatural['domicilio']['lote'],
        "sublote" => $personaNatural['domicilio']['subLote'],
        "codi_dep" => $personaNatural['domicilio']['codigoDepartamento'],
        "codi_pro" => $personaNatural['domicilio']['codigoProvincia'],
        "codi_dis" => $personaNatural['domicilio']['codigoDistrito'],
      ]);
    }
  }

  if (count($dataPost['identificacionTitularCatastral']['personasJuridicas']) > 0) {
    foreach ($dataPost['identificacionTitularCatastral']['personasJuridicas'] as $personaJuridica) {

      $idPersonaJuridica = $personaJuridica['tipo']
        . $personaJuridica['tipoPersonaJuridica']
        . $personaJuridica['ruc'];

      $datosPersonaJuridica = [
        "id_persona" => trim($idPersonaJuridica),
        "nume_doc" => $personaJuridica['ruc'],
        "tipo_doc" => '',
        "tipo_persona" => $personaJuridica['tipo'],
        "nombres" => '',
        "ape_paterno" => '',
        "ape_materno" => '',
        "tipo_persona_juridica" => $personaJuridica['tipoPersonaJuridica'],
        "tipo_funcion" => '',
        "razon_social" => $personaJuridica['razonSocial'],
      ];

      // Guardar Persona Juridica
      $resultadoGuardarPersonaJuridica = callApiPost('guardarPersona.php', $datosPersonaJuridica);

      if (!$resultadoGuardarPersonaJuridica["success"]) {
        return createResponse(false, null, 'Error registrando persona juridica');
      }

      $idPersonaJuridicaGuardado = $resultadoGuardarPersonaJuridica['data']['id_persona'];

      array_push($datosTitulares, [
        "id_ficha" => $idFichaGuardado,
        "id_persona" => $idPersonaJuridicaGuardado,
        "form_adquisicion" => $personaJuridica['caracteristicas']['formaAdquisicion'],
        "fecha_adquisicion" => $personaJuridica['caracteristicas']['fechaAdquisicion'],
        "porc_cotitular" => '0.0',
        "esta_civil" => '00',
        "fax" => '',
        "telf" => $personaJuridica['domicilio']['telefono'],
        "anexo" => $personaJuridica['domicilio']['anexo'],
        "email" => $personaJuridica['domicilio']['correo'],
        "nume_titular" => '',
        "codi_contribuyente" => '',
        "cond_titular" => $personaJuridica['caracteristicas']['condicionTitular']
      ]);

      array_push($datosDomicilioTitulares, [
        "id_ficha" => $idFichaGuardado,
        "id_persona" => trim($idPersonaJuridicaGuardado),
        "codi_via" => trim($personaJuridica['domicilio']['codigoVia']),
        "tipo_via" => $personaJuridica['domicilio']['tipoVia'],
        "nomb_via" => $personaJuridica['domicilio']['nombreVia'],
        "nume_muni" => $personaJuridica['domicilio']['numeroMunicipal'],
        "nomb_edificacion" => '',
        "nume_interior" => $personaJuridica['domicilio']['numeroInterior'],
        "codi_hab_urba" => $personaJuridica['domicilio']['codigoHU'],
        "nomb_hab_urba" => $personaJuridica['domicilio']['nombreHU'],
        "sector" => $personaJuridica['domicilio']['zonaSectorEtapa'],
        "mzna" => $personaJuridica['domicilio']['manzana'],
        "lote" => $personaJuridica['domicilio']['lote'],
        "sublote" => $personaJuridica['domicilio']['subLote'],
        "codi_dep" => $personaJuridica['domicilio']['codigoDepartamento'],
        "codi_pro" => $personaJuridica['domicilio']['codigoProvincia'],
        "codi_dis" => $personaJuridica['domicilio']['codigoDistrito'],
      ]);
    }
  }

  if (count($datosTitulares) > 0) {
    $resultadoGuardarTitulares = callApiPost('guardarTitulares.php', $datosTitulares);

    if (!$resultadoGuardarTitulares["success"]) {
      return createResponse(false, null, 'Error registrando titulares');
    }
  }

  if (count($datosDomicilioTitulares) > 0) {
    $resultadoGuardarDomicilioTitulares = callApiPost('guardarDomicilioTitulares.php', $datosDomicilioTitulares);

    if (!$resultadoGuardarDomicilioTitulares["success"]) {
      return createResponse(false, null, 'Error registrando domicilio titulares');
    }
  }

  // Guardar litigantes
  $datosLitigantes = [];

  if (count($dataPost['litigantes']) > 0) {
    foreach ($dataPost['litigantes'] as $litigante) {
      $tipoPersonaPorDefecto = '1'; // Persona natural
      $tipoDocumentoPorDefecto = '02'; //DNI

      $idPersonaLitigante = $tipoPersonaPorDefecto
       . $tipoDocumentoPorDefecto
       . $litigante['numero_documento'];

      $datosPersonaLitigante = [
        "id_persona" => $idPersonaLitigante,
        "nume_doc" => $litigante['numero_documento'],
        "tipo_doc" => '',
        "tipo_persona" => '',
        "nombres" => $litigante['nombres_apellidos'], // SE GUARDA EL NOMBRE DE LITIGANTE COMPLETO
        "ape_paterno" => '',
        "ape_materno" => '',
        "tipo_persona_juridica" => '',
        "tipo_funcion" => '',
        "razon_social" => '',
      ];

      // Guardar Persona Litigante
      $resultadoGuardarPersonaLitigante = callApiPost('guardarPersona.php', $datosPersonaLitigante);

      if (!$resultadoGuardarPersonaLitigante["success"]) {
        return createResponse(false, null, 'Error registrando persona litigante');
      }

      $idPersonaLitiganteGuardado = $resultadoGuardarPersonaLitigante['data']['id_persona'];

      $datosLitigantes[] = [
        "id_ficha" => $idFichaGuardado,
        "id_persona" => $idPersonaLitiganteGuardado,
        "codi_contribuye" => $litigante['codigo_contribuyente'],
      ];
    }
  }

  if (count($datosLitigantes) > 0) {
    $resultadoGuardarLitigantes = callApiPost('guardarLitigantes.php', $datosLitigantes);

    if (!$resultadoGuardarLitigantes["success"]) {
      return createResponse(false, null, 'Error registrando litigantes');
    }
  }

  // Guardar ficha codigos antiguos
  if (!empty($dataPost['observaciones']['codigoCatastralAntiguo'])) {
    $datosCodigoFichaAntiguo = [
      "id_ficha" => $idFichaGuardado,
      "codigo_catastral" => $dataPost['observaciones']['codigoCatastralAntiguo'],
    ];

    $resultadoGuardarFichasCodigosAntiguos = callApiPost('guardarFichaCodigosAntiguos.php', $datosCodigoFichaAntiguo);

    if (!$resultadoGuardarFichasCodigosAntiguos["success"]) {
      return createResponse(false, null, 'Error registrando fichas codigos antiguos');
    }
  }

  // Guardar vias
  $vias = $dataPost['puertasPredioCatastral'];
  $datosViasHUS = [];

  if (count($vias) > 0) {

    foreach ($vias as $via) {
      $datosPuertas = [];
      $idVia = $via['idVia'];

      array_push($datosViasHUS, [
        'id_hab_urba' => trim($idHU),
        'id_via' => trim($idVia)
      ]);

      foreach ($via['puertas'] as $puerta) {
        $datosPuerta = [
          'id_puerta' => trim($idLoteGuardado . $puerta['codigo']),
          'id_lote' => trim($idLoteGuardado),
          'codi_puerta' => $puerta['codigo'],
          'tipo_puerta' => $puerta['tipo'],
          'nume_muni' => $puerta['numeroMunicipal'],
          'cond_nume' => '',
          'id_via' => trim($idVia),
          'nume_certificacion' => ''
        ];

        array_push($datosPuertas, $datosPuerta);
      }

      $puertasGuardadas = callApiPost('guardarPuertas.php', $datosPuertas);

      if (!$puertasGuardadas["success"]) {
        return createResponse(false, null, 'Error registrando puertas');
      }

      // Guardar ingresos
      $datosIngresos = [];

      foreach ($datosPuertas as $puertaIngresada) {
        array_push($datosIngresos, [
          'id_ficha' => $idFichaGuardado,
          'id_puerta' => $puertaIngresada['id_puerta']
        ]);
      }

      $ingresosGuardadas = callApiPost('guardarIngresos.php', $datosIngresos);

      if (!$ingresosGuardadas["success"]) {
        return createResponse(false, null, 'Error registrando ingresos');
      }
    }
  }

  if (count($datosViasHUS) > 0) {
    // Guardar HUS
    $resultadoViasHUSGuardadas = callApiPost('guardarViasHUS.php', $datosViasHUS);

    if (!$resultadoViasHUSGuardadas["success"]) {
      return createResponse(false, null, 'Error registrando vias HUS');
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
    'tv_cable' => $dataPost['serviciosBasicos']['cable'],
    'gas_natural' => $dataPost['serviciosBasicos']['gas'],
    'internet' => $dataPost['serviciosBasicos']['internet'],
  ];

  $resultadoGuardarServicios = callApiPost('guardarServicios.php', $datosServicios);

  if (!$resultadoGuardarServicios["success"]) {
    return createResponse(false, null, 'Error registrando servicios ');
  }

  // Guardar construcciones
  $datosConstrucciones = [];

  if (count($dataPost['construcciones']) > 0) {
    foreach ($dataPost['construcciones'] as $construccion) {
      $datosConstruccion = [
        'id_construccion' => $idFichaGuardado,
        'id_ficha' => $idFichaGuardado,
        'codi_construccion' => $construccion['codigo'],
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
        'area_declarada' => '0.00',
        'area_verificada' => $construccion['area_verificada'],
        'uca' => ''
      ];

      array_push($datosConstrucciones, $datosConstruccion);
    }

    $resultadoGuardarConstrucciones = callApiPost('guardarConstrucciones.php', $datosConstrucciones);

    if (!$resultadoGuardarConstrucciones["success"]) {
      return createResponse(false, null, 'Error registrando construcciones ');
    }
  }

  // Guardar instalaciones
  $datosInstalaciones = [];

  if (count($dataPost['obrasComplementarias']) > 0) {
    foreach ($dataPost['obrasComplementarias'] as $obraComplementaria) {
      array_push($datosInstalaciones, [
        'id_instalacion' => trim($idFichaGuardado .  $obraComplementaria['codigo_instalacion'] . $obraComplementaria['correlativo']),
        'id_ficha' => trim($idFichaGuardado),
        'codi_instalacion' => $obraComplementaria['codigo_instalacion'],
        'codi_obra' => $obraComplementaria['correlativo'],
        'fecha' => $obraComplementaria['fecha'],
        'mep' => $obraComplementaria['mep'],
        'ecs' => $obraComplementaria['ecs'],
        'ecc' => $obraComplementaria['ecc'],
        'dime_largo' => $obraComplementaria['dimension_largo'],
        'dime_ancho' => $obraComplementaria['dimension_ancho'],
        'dime_alto' => $obraComplementaria['dimension_alto'],
        'prod_total' => $obraComplementaria['produccion_total'],
        'uni_med' => $obraComplementaria['unidad_medida'],
        'uca' => $obraComplementaria['uca'],
      ]);
    }

    $resultadoGuardarInstalaciones = callApiPost('guardarInstalaciones.php', $datosInstalaciones);

    if (!$resultadoGuardarInstalaciones["success"]) {
      return createResponse(false, null, 'Error registrando instalaciones');
    }
  }

  // Guardar linderos
  $datosLindero = [
    'id_ficha' => $idFichaGuardado,
    'fren_campo' => $dataPost['descripcionPredio']['linderos'][0]['medida'] ?? '',
    'fren_titulo' => '',
    'fren_colinda_campo' => $dataPost['descripcionPredio']['linderos'][0]['colindancia'] ?? '',
    'fren_colinda_titulo' => '',
    'dere_campo' => $dataPost['descripcionPredio']['linderos'][1]['medida'] ?? '',
    'dere_titulo' => '',
    'dere_colinda_campo' => $dataPost['descripcionPredio']['linderos'][1]['medida'] ?? '',
    'dere_colinda_titulo' => '',
    'izqu_campo' => $dataPost['descripcionPredio']['linderos'][2]['medida'] ?? '',
    'izqu_titulo' => '',
    'izqu_colinda_campo' => $dataPost['descripcionPredio']['linderos'][2]['medida'] ?? '',
    'izqu_colinda_titulo' => '',
    'fond_campo' => $dataPost['descripcionPredio']['linderos'][3]['medida'] ?? '',
    'fond_titulo' => '',
    'fond_colinda_campo' => $dataPost['descripcionPredio']['linderos'][3]['medida'] ?? '',
    'fond_colinda_titulo' => ''
  ];

  $resultadoGuardarLinderos = callApiPost('guardarLindero.php', $datosLindero);

  if (!$resultadoGuardarLinderos["success"]) {
    return createResponse(false, null, 'Error registrando linderos ');
  }

  createResponse(true, $resultadoGuardarFichaIndividual["data"]);

} catch (Exception $e) {
  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($BD)) {
    $BD->desconectar();
  }
}
