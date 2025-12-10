<?php

// Desactivar errores en salida
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Limpiar buffer SOLO si existe
// if (ob_get_length()) {
//   ob_clean();
// }

header('Content-Type: application/json; charset=utf-8');

require_once "./_DBPostgres.php";
require_once "./_CreateResponse.php";
require_once "./_CallApi.php";

// inserts
require_once "./LoteRepository.php";
require_once "./EdificacionRepository.php";
require_once "./UniCatRepository.php";
require_once "./FichaRepository.php";
require_once "./FichaIndividualRepository.php";
require_once "./DeclaranteRepository.php";
require_once "./SunarpRepository.php";
require_once "./PersonaRepository.php";
require_once "./TitularesRepository.php";
require_once "./DocumentosRepository.php";
require_once "./DomicilioTitularesRepository.php";
require_once "./LitigantesRepository.php";
require_once "./FichaCodigosAntiguosRepository.php";
require_once "./PuertasRepository.php";
require_once "./IngresosRepository.php";
require_once "./ViasHUSRepository.php";
require_once "./ServiciosRepository.php";
require_once "./LinderosRepository.php";
require_once "./InstalacionesRepository.php";
require_once "./ConstruccionesRepository.php";
require_once "./ArchivosRepository.php";

try {
  if (!isset($_POST['dataPost'])) {
    throw new Exception("No se recibieron datos");
  }

  $dataPost = json_decode($_POST['dataPost'], true);

  if (!$dataPost) {
    throw new Exception("Error decodificando JSON");
  }

  $cabecera = $dataPost['cabecera'];
  $caracteristicasTitularidad = $dataPost['caracteristicasTitularidad'];
  $construcciones = $dataPost['construcciones'];
  $datosGenerales = $dataPost['datosGenerales'];
  $descripcionPredio = $dataPost['descripcionPredio'];
  $documentos = $dataPost['documentos'];
  $domicilioTitular = $dataPost['domicilioTitular'];
  $evaluacionPredio = $dataPost['evaluacionPredio'];
  $firmas = $dataPost['firmas'];
  $identificacionTitular = $dataPost['identificacionTitular'];
  $informacionComplementaria = $dataPost['informacionComplementaria'];
  $inscripcionPredio = $dataPost['inscripcionPredio'];
  $obrasComplementarias = $dataPost['obrasComplementarias'];
  $observaciones = $dataPost['observaciones'];
  $serviciosBasicos = $dataPost['serviciosBasicos'];
  $ubicacionPredio = $dataPost['ubicacionPredio'];

  $anioActual = date("Y");
  $codiUbigeo = $datosGenerales['codi_dep'] . $datosGenerales['codi_pro'] . $datosGenerales['codi_dis'];

  $db = new DBPostgres();
  $db->conectar();

  $db->beginTransaction();

  $loteRepository = new LoteRepository($db);
  $edificacionRepository = new EdificacionRepository($db);
  $uniCatRepository = new UniCatRepository($db);
  $fichaRepository = new FichaRepository($db);
  $fichaIndividualRepository = new FichaIndividualRepository($db);
  $declaranteRepository = new DeclaranteRepository($db);
  $sunarpRepository = new SunarpRepository($db);
  $personaRepository = new PersonaRepository($db);
  $documentosRepository = new DocumentosRepository($db);
  $titularesRepository = new TitularesRepository($db);
  $domicilioTitularesRepository = new DomicilioTitularesRepository($db);
  $litigantesRepository = new LitigantesRepository($db);
  $fichaCodigosAntiguosRepository = new FichaCodigosAntiguosRepository($db);
  $puertasRepository = new PuertasRepository($db);
  $viasHUSRepository = new ViasHUSRepository($db);
  $ingresosRepository = new IngresosRepository($db);
  $serviciosRepository = new ServiciosRepository($db);
  $linderosRepository = new LinderosRepository($db);
  $instalacionesRepository = new InstalacionesRepository($db);
  $construccionesRepository = new ConstruccionesRepository($db);
  $archivosRepository = new ArchivosRepository($db);

  $datosLote = [
    "id_lote" => trim($datosGenerales["id_mzna"] . $datosGenerales["codi_lote"]),
    "id_mzna" => trim($datosGenerales["id_mzna"]),
    "codi_lote" => $datosGenerales["codi_lote"],
    "id_hab_urba" => trim($ubicacionPredio['id_hab_urba']),
    "mzna_dist" => $datosGenerales["nume_mzna"],
    "lote_dist" => $ubicacionPredio["lote_dist"],
    "sub_lote_dist" => $ubicacionPredio['sub_lote_dist'],
    "estructuracion" => "",
    "zonificacion" => "",
    "cuc" => "",
    "zona_dist" => "",
  ];

  $loteRepository->guardarLote($datosLote);

  $datosEdificacion = [
    "id_edificacion" => trim($datosLote['id_lote'] . $datosGenerales['codi_edificacion']),
    "id_lote" => trim($datosLote['id_lote']),
    "codi_edificacion" => $datosGenerales['codi_edificacion'],
    "tipo_edificacion" => $ubicacionPredio['tipo_edificacion'],
    "nomb_edificacion" => '',
    "clasificacion" => '',
  ];

  $edificacionRepository->guardarEdificacion($datosEdificacion);

  $datosUniCat = [
    "id_uni_cat" => trim($datosEdificacion['id_edificacion'] . $datosGenerales['codi_entrada'] . $datosGenerales['codi_piso'] . $datosGenerales['codi_unidad']),
    "id_lote" => $datosLote['id_lote'],
    "id_edificacion" => $datosEdificacion['id_edificacion'],
    "codi_entrada" => $datosGenerales['codi_entrada'],
    "codi_piso" => $datosGenerales['codi_piso'],
    "codi_unidad" => $datosGenerales['codi_unidad'],
    "tipo_interior" => $ubicacionPredio['tipo_interior'],
    "cuc" => $datosGenerales['cuc_1'] . $datosGenerales['cuc_2'],
    "cuc_antecedente" => "",
    "codi_hoja_catastral" => "",
    "codi_pred_rentas" => $datosGenerales['codi_pred_rentas'],
    "nume_interior" => $ubicacionPredio['nume_interior'],
    "unid_acum_rentas" => "",
    "codi_cont_rentas" => $datosGenerales['codi_cont_rentas'],
  ];

  $uniCatRepository->guardarUniCat($datosUniCat);

  $datosFicha = [
    "id_ficha" => trim($anioActual . $codiUbigeo . $cabecera['tipo_ficha'] . $cabecera['nume_ficha']),
    "tipo_ficha" => $cabecera['tipo_ficha'],
    "nume_ficha" => $cabecera['nume_ficha'],
    "id_lote" => $datosLote['id_lote'],
    "dc" => $datosGenerales['dc'],
    "nume_ficha_lote" => $cabecera['nume_ficha_lote_1'] . $cabecera['nume_ficha_lote_2'],
    "declarante" => $firmas['declarante']['dni'],
    "fecha_declarante" => validarFecha($firmas['declarante']['fecha_declarante']),
    "supervisor" => $firmas['supervisor']['dni'],
    "fecha_supervision" => validarFecha($firmas['supervisor']['fecha']),
    "tecnico" => $firmas['tecnico']['dni'],
    "fecha_levantamiento" => validarFecha($firmas['tecnico']['fecha']),
    "verificador" => $firmas['verificador']['dni'],
    "fecha_verificacion" => validarFecha($firmas['verificador']['fecha']),
    "nume_registro" => $firmas['verificador']['nume_registro'],
    "id_uni_cat" => $datosUniCat['id_uni_cat'],
    'id_usuario' => trim($cabecera['id_usuario']),
    'fecha_grabado' => date("Y-m-d"),
    "activo" => "1"
  ];

  $fichaRepository->guardarFicha($datosFicha);

  if ($firmas['declarante']['dni'] !== '') {
    $declaranteRepository->guardarDeclarante([
      "dni" => $firmas['declarante']['dni'],
      "nombres" => $firmas['declarante']['nombres'],
      "ape_paterno" => $firmas['declarante']['ape_paterno'],
      "ape_materno" => $firmas['declarante']['ape_materno'],
      "fecha" => validarFecha($firmas['declarante']['fecha_declarante']),
      "id_ficha" => trim($datosFicha['id_ficha']),
    ]);
  }


  $datosFichaIndividual = [
    "id_ficha" => $datosFicha['id_ficha'],
    "codi_uso" => $descripcionPredio['codi_uso'],
    "cont_en" => '',
    "clasificacion" => $descripcionPredio['clasificacion'],
    "area_titulo" => validarNumero($descripcionPredio['area_titulo']),
    "area_declarada" => 0,
    "area_verificada" => validarNumero($descripcionPredio['area_verificada']),
    "porc_bc_terr_legal" => 0,
    "porc_bc_terr_fisc" => 0,
    "porc_bc_const_legal" => 0,
    "porc_bc_const_fisc" => 0,
    "evaluacion" => '',
    "en_colindante" => validarNumero($evaluacionPredio['en_colindante']),
    "en_jardin_aislamiento" => validarNumero($evaluacionPredio['en_jardin_aislamiento']),
    "en_area_publica" => validarNumero($evaluacionPredio['en_area_publica']),
    "en_area_intangible" => validarNumero($evaluacionPredio['en_area_intangible']),
    "cond_declarante" => $informacionComplementaria['cond_declarante'] ?? '',
    "esta_llenado" => $informacionComplementaria['esta_llenado'] ?? '',
    "nume_habitantes" => validarNumero($informacionComplementaria['nume_habitantes']),
    "nume_familias" => validarNumero($informacionComplementaria['nume_familias']),
    "mantenimiento" => $informacionComplementaria['mantenimiento'] ?? '',
    "observaciones" => $observaciones['observaciones'] ?? '',
    "nume_ficha" => $cabecera['nume_ficha']
  ];

  $fichaIndividualRepository->guardarFichaIndividual($datosFichaIndividual);

  $sunarpRepository->guardarSunarp([
    "id_ficha" => $datosFicha['id_ficha'],
    "tipo_partida" => $inscripcionPredio['tipo_partida'] ?? '',
    "nume_partida" => $inscripcionPredio['nume_partida'] ?? '',
    "fojas" => $inscripcionPredio['fojas'] ?? '',
    "asiento" => $inscripcionPredio['asiento'] ?? '',
    "fecha_inscripcion" => validarFecha($inscripcionPredio['fecha_inscripcion']),
    "codi_decla_fabrica" => $inscripcionPredio['codi_decla_fabrica'] ?? '',
    "asie_fabrica" => $inscripcionPredio['asie_fabrica'] ?? '',
    "fecha_fabrica" => validarFecha($inscripcionPredio['fecha_fabrica']),
  ]);

  if ($caracteristicasTitularidad['cond_titular'] !== '05') { // SI NO ES COTITULARIDAD

    //PERSONA NATURAL
    if (count($identificacionTitular['personaNatural']) > 0) {

      $personaNatural = $identificacionTitular['personaNatural'][0];

      $datosPersonaNatural = [
        "id_persona" => trim($identificacionTitular['tipo_persona'] . $personaNatural['tipo_doc'] . $personaNatural['nume_doc']),
        "nume_doc" => $personaNatural['nume_doc'],
        "tipo_doc" => $personaNatural['tipo_doc'],
        "tipo_persona" => $identificacionTitular['tipo_persona'],
        "nombres" => $personaNatural['nombres'],
        "ape_paterno" => $personaNatural['ape_paterno'],
        "ape_materno" => $personaNatural['ape_materno'],
        "tipo_persona_juridica" => '',
        "tipo_funcion" => '',
        "razon_social" => '',
      ];

      $personaBuscada = $personaRepository->obtenerPersonaPorNumeDoc($personaNatural['nume_doc']);

      if (!$personaBuscada) {
        $personaRepository->guardarPersona($datosPersonaNatural);
      }

      $datosTitularNatural = [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaNatural['id_persona'],
        "form_adquisicion" => $caracteristicasTitularidad['form_adquisicion'],
        "fecha_adquisicion" => validarFecha($caracteristicasTitularidad['fecha_adquisicion']),
        "porc_cotitular" => '0.0',
        "esta_civil" => $personaNatural['esta_civil'],
        "fax" => '',
        "telf" => $domicilioTitular['telefono'],
        "anexo" => $domicilioTitular['anexo'],
        "email" => $domicilioTitular['correo'],
        "nume_titular" => '',
        "codi_contribuyente" => '',
        "cond_titular" => $caracteristicasTitularidad['cond_titular']
      ];

      $titularesRepository->guardarTitularesMultiple([$datosTitularNatural]);

      $datosDomicilioTitularNatural = [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaNatural['id_persona'],
        "codi_via" => trim($domicilioTitular['codi_via']),
        "tipo_via" => $domicilioTitular['tipo_via'],
        "nomb_via" => $domicilioTitular['nomb_via'],
        "nume_muni" => $domicilioTitular['nume_muni'],
        "nomb_edificacion" => '',
        "nume_interior" => $domicilioTitular['nume_interior'],
        "codi_hab_urba" => $domicilioTitular['codi_hab_urba'],
        "nomb_hab_urba" => $domicilioTitular['nomb_hab_urba'],
        "sector" => $domicilioTitular['zona_sector_etapa'],
        "mzna" => $domicilioTitular['mzna'],
        "lote" => $domicilioTitular['lote'],
        "sublote" => $domicilioTitular['sublote'],
        "codi_dep" => $domicilioTitular['codi_dep'],
        "codi_pro" => $domicilioTitular['codi_pro'],
        "codi_dis" => $domicilioTitular['codi_dis'],
      ];

      $domicilioTitularesRepository->guardarDomicilioTitularesMultiple([$datosDomicilioTitularNatural]);
    }

    // CONYUGE
    $conyugue = $identificacionTitular['conyugue'];

    if (count($identificacionTitular['conyugue']) > 0) {
      //
    }

    // PERSONA JURIDICA
    if (count($identificacionTitular['personaJuridica']) > 0) {

      $personaJuridica = $identificacionTitular['personaJuridica'][0];

      $datosPersonaJuridica = [
        "id_persona" => trim($identificacionTitular['tipo_persona'] . $personaJuridica['tipo_persona_juridica'] . $personaJuridica['ruc']),
        "nume_doc" => $personaJuridica['ruc'],
        "tipo_doc" => '',
        "tipo_persona" => $identificacionTitular['tipo_persona'],
        "nombres" => '',
        "ape_paterno" => '',
        "ape_materno" => '',
        "tipo_persona_juridica" => $personaJuridica['tipo_persona_juridica'],
        "tipo_funcion" => '',
        "razon_social" => $personaJuridica['razon_social'],
      ];

      $personaJuridicaBuscada = $personaRepository->obtenerPersonaPorNumeDoc($personaJuridica['ruc']);

      if (!$personaJuridicaBuscada) {
        $personaRepository->guardarPersona($datosPersonaJuridica);
      }

      $datosTitularJuridico = [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaJuridica['id_persona'],
        "form_adquisicion" => $caracteristicasTitularidad['form_adquisicion'],
        "fecha_adquisicion" => validarFecha($caracteristicasTitularidad['fecha_adquisicion']),
        "porc_cotitular" => '0.0',
        "esta_civil" => '',
        "fax" => '',
        "telf" => $domicilioTitular['telefono'],
        "anexo" => $domicilioTitular['anexo'],
        "email" => $domicilioTitular['correo'],
        "nume_titular" => '',
        "codi_contribuyente" => '',
        "cond_titular" => $caracteristicasTitularidad['cond_titular']
      ];

      $titularesRepository->guardarTitularesMultiple([$datosTitularJuridico]);

      $datosDomicilioTitularJuridico = [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaJuridica['id_persona'],
        "codi_via" => trim($domicilioTitular['codi_via']),
        "tipo_via" => $domicilioTitular['tipo_via'],
        "nomb_via" => $domicilioTitular['nomb_via'],
        "nume_muni" => $domicilioTitular['nume_muni'],
        "nomb_edificacion" => '',
        "nume_interior" => $domicilioTitular['nume_interior'],
        "codi_hab_urba" => $domicilioTitular['codi_hab_urba'],
        "nomb_hab_urba" => $domicilioTitular['nomb_hab_urba'],
        "sector" => $domicilioTitular['zona_sector_etapa'],
        "mzna" => $domicilioTitular['mzna'],
        "lote" => $domicilioTitular['lote'],
        "sublote" => $domicilioTitular['sublote'],
        "codi_dep" => $domicilioTitular['codi_dep'],
        "codi_pro" => $domicilioTitular['codi_pro'],
        "codi_dis" => $domicilioTitular['codi_dis'],
      ];

      $domicilioTitularesRepository->guardarDomicilioTitularesMultiple([$datosDomicilioTitularJuridico]);
    }
  }

  $datosLitigantes = [];

  if (count($informacionComplementaria['litigantes']) > 0) {
    foreach ($informacionComplementaria['litigantes'] as $litigante) {
      $TIPO_PERSONA_NATURAL = '1';
      $TIPO_DOCUMENTO_DNI = '02';

      $datosPersonaLitigante = [
        "id_persona" => trim($TIPO_PERSONA_NATURAL . $TIPO_DOCUMENTO_DNI . $litigante['nume_doc']),
        "nume_doc" => $litigante['nume_doc'],
        "tipo_doc" => '',
        "tipo_persona" => '',
        "nombres" => $litigante['nombres_ape'],
        "ape_paterno" => '',
        "ape_materno" => '',
        "tipo_persona_juridica" => '',
        "tipo_funcion" => '',
        "razon_social" => '',
      ];

      $litiganteBuscado = $personaRepository->obtenerPersonaPorNumeDoc($litigante['nume_doc']);

      if (!$litiganteBuscado) {
        $personaRepository->guardarPersona($datosPersonaLitigante);
      }



      $datosLitigantes[] = [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaLitigante['id_persona'],
        "codi_contribuye" => $litigante['codi_contribuye'],
      ];
    }
  }

  if (count($datosLitigantes) > 0) {
    $litigantesRepository->guardarLitigantesMultiple($datosLitigantes);
  }

  $fichaCodigosAntiguosRepository->guardarFichaCodigosAntiguos([
    "id_ficha" => $datosFicha['id_ficha'],
    "codigo_catastral" => $observaciones['codigo_catastral'],
  ]);


  $vias = $ubicacionPredio['vias'];
  $datosViasHUS = [];

  if (count($vias) > 0) {

    foreach ($vias as $via) {
      $datosPuertas = [];
      $idVia = $via['id_via'];

      array_push($datosViasHUS, [
        'id_hab_urba' => trim($ubicacionPredio['id_hab_urba']),
        'id_via' => trim($idVia)
      ]);

      foreach ($via['puertas'] as $puerta) {
        $datosPuerta = [
          'id_puerta' => trim($datosLote['id_lote'] . $puerta['codigo']),
          'id_lote' => trim($datosLote['id_lote']),
          'codi_puerta' => $puerta['codigo'],
          'tipo_puerta' => $puerta['tipo_puerta'],
          'nume_muni' => $puerta['nume_muni'],
          'cond_nume' => $puerta['cond_nume'],
          'id_via' => trim($idVia),
          'nume_certificacion' => '',
        ];

        array_push($datosPuertas, $datosPuerta);
      }

      $puertasRepository->guardarPuertasMultiple($datosPuertas);

      $datosIngresos = [];

      foreach ($datosPuertas as $datosPuertaItem) {
        array_push($datosIngresos, [
          'id_ficha' => $datosFicha['id_ficha'],
          'id_puerta' => $datosPuertaItem['id_puerta']
        ]);
      }

      $ingresosRepository->guardarIngresosMultiple($datosIngresos);
    }
  }

  if (count($datosViasHUS) > 0) {
    $viasHUSRepository->guardarViasHUSMultiple($datosViasHUS);
  }

  $serviciosRepository->guardarServicios([
    'id_ficha' => trim($datosFicha['id_ficha']),
    'luz' => $serviciosBasicos['luz'],
    'agua' => $serviciosBasicos['agua'],
    'telefono' => $serviciosBasicos['telefono'],
    'desague' => $serviciosBasicos['desague'],
    'nume_sum_luz' => '',
    'nume_telefono' => '',
    'nume_contrato_agua' => '',
    'tv_cable' => $serviciosBasicos['cable'],
    'gas_natural' => $serviciosBasicos['gas'],
    'internet' => $serviciosBasicos['internet'],
  ]);


  $datosConstrucciones = [];

  if (count($construcciones) > 0) {
    foreach ($construcciones as $construccion) {
      $datosConstruccion = [
        'id_construccion' => trim($datosFicha['id_ficha'] . $construccion['codigo']),
        'id_ficha' => $datosFicha['id_ficha'],
        'codi_construccion' => $construccion['codigo'],
        'nume_piso' => $construccion['nume_piso'],
        'fecha' => $construccion['fecha'],
        'mep' => $construccion['mep'],
        'ecs' => $construccion['ecs'],
        'ecc' => $construccion['ecc'],
        'estr_muro_col' => $construccion['estr_muro_col'],
        'estr_techo' => $construccion['estr_techo'],
        'acab_piso' => $construccion['acab_piso'],
        'acab_puerta_ven' => $construccion['acab_puerta_ven'],
        'acab_revest' => $construccion['acab_revest'],
        'acab_bano' => $construccion['acab_bano'],
        'inst_elect_sanita' => $construccion['inst_elect_sanita'],
        'area_declarada' => '0.00',
        'area_verificada' => $construccion['area_verificada'],
        'uca' => $construccion['uca']
      ];

      array_push($datosConstrucciones, $datosConstruccion);
    }

    $construccionesRepository->guardarConstruccionesMultiple($datosConstrucciones);
  }

  $datosInstalaciones = [];

  if (count($obrasComplementarias) > 0) {
    foreach ($obrasComplementarias as $obraComplementaria) {
      array_push($datosInstalaciones, [
        'id_instalacion' => trim($datosFicha['id_ficha'] .  $obraComplementaria['codi_instalacion'] . $obraComplementaria['codigo']),
        'id_ficha' => trim($datosFicha['id_ficha']),
        'codi_instalacion' => $obraComplementaria['codi_instalacion'],
        'codi_obra' => $obraComplementaria['codigo'],
        'fecha' => $obraComplementaria['fecha'],
        'mep' => $obraComplementaria['mep'],
        'ecs' => $obraComplementaria['ecs'],
        'ecc' => $obraComplementaria['ecc'],
        'dime_largo' => 0.0,
        'dime_ancho' => 0.0,
        'dime_alto' => 0.0,
        'prod_total' => $obraComplementaria['prod_total'],
        'uni_med' => $obraComplementaria['uni_med'],
        'uca' => $obraComplementaria['uca'],
      ]);
    }

    $instalacionesRepository->guardarInstalacionesMultiple($datosInstalaciones);
  }

  $datosLindero = [
    'id_ficha' => $datosFicha['id_ficha'],
    'fren_campo' => $descripcionPredio['fren_campo'],
    'fren_titulo' => '',
    'fren_colinda_campo' => $descripcionPredio['fren_colinda_campo'],
    'fren_colinda_titulo' => '',
    'dere_campo' => $descripcionPredio['dere_campo'],
    'dere_titulo' => '',
    'dere_colinda_campo' => $descripcionPredio['dere_colinda_campo'],
    'dere_colinda_titulo' => '',
    'izqu_campo' => $descripcionPredio['izqu_campo'],
    'izqu_titulo' => '',
    'izqu_colinda_campo' => $descripcionPredio['izqu_colinda_campo'],
    'izqu_colinda_titulo' => '',
    'fond_campo' => $descripcionPredio['fond_campo'],
    'fond_titulo' => '',
    'fond_colinda_campo' => $descripcionPredio['fond_colinda_campo'],
    'fond_colinda_titulo' => ''
  ];

  $linderosRepository->guardarLinderos($datosLindero);

  $datosDocumentos = [];

  if (count($documentos) > 0) {
    foreach ($documentos as $documento) {

      $codigo = str_pad($documento['codigo'], 2, '0', STR_PAD_LEFT);

      array_push($datosDocumentos, [
        'id_doc' => trim($datosFicha['id_ficha'] . $codigo),
        'id_ficha' => $datosFicha['id_ficha'],
        'codi_doc' => $codigo,
        'tipo_doc' => $documento['tipo_doc'],
        'nume_doc' => $documento['nume_doc'],
        'area_autorizada' => $documento['area_autorizada'],
        "fecha_doc" => validarFecha($documento['fecha_doc']),
      ]);
    }

    $documentosRepository->guardarVariosDocumentos($datosDocumentos);
  }

  $db->commit();

  createResponse(true, $datosFicha);

} catch (Exception $e) {
  $db->rollback();

  createResponse(false, 'Error general', $e->getMessage());
} finally {
  if (isset($db)) {
    $db->desconectar();
  }
}

function validarFecha($valor)
{
  return !empty($valor) ? $valor : null;
}

function validarNumero($valor)
{
  return !empty($valor) ? $valor : 0;
}

// if (isset($_FILES['archivos'])) {
//   $archivos = $_FILES['archivos'];
//   $archivosRepository->guardarArchivos($datosFicha['id_ficha'], $archivos);
// }
