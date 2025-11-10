<?php

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

  $anioActual = date("Y");
  $tipoFicha = "01"; // Ficha individual
  $numeFicha = $dataPost['numeFicha'];
  $ubigeo = $dataPost['ubigeo'];
  $codiUbigeo = $ubigeo['codi_dep'] . $ubigeo['codi_pro'] . $ubigeo['codi_dis'];
  $codigoReferenciaCatastral = $dataPost['codigoReferenciaCatastral'];
  $ubicacionPredioCatastral = $dataPost['ubicacionPredioCatastral'];

  // $nombreHU = $ubicacionPredioCatastral['nombreHU'];
  // $codigoHU = $ubicacionPredioCatastral['codigoHU'];

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
    "id_lote" => trim($codigoReferenciaCatastral["id_mzna"] . $codigoReferenciaCatastral["codi_lote"]),
    "id_mzna" => trim($codigoReferenciaCatastral["id_mzna"]),
    "codi_lote" => $codigoReferenciaCatastral["codi_lote"],
    "id_hab_urba" => trim($ubicacionPredioCatastral['id_hab_urba']),
    "mzna_dist" => $codigoReferenciaCatastral["nume_mzna"],
    "lote_dist" => $ubicacionPredioCatastral["lote_dist"],
    "sub_lote_dist" => $ubicacionPredioCatastral['sub_lote_dist'],
    "estructuracion" => "",
    "zonificacion" => "",
    "cuc" => "",
    "zona_dist" => $ubicacionPredioCatastral['grup_urba'],
  ];

  $loteRepository->guardarLote($datosLote);

  $datosEdificacion = [
    "id_edificacion" => trim($datosLote['id_lote'] . $codigoReferenciaCatastral['codi_edificacion']),
    "id_lote" => $datosLote['id_lote'],
    "codi_edificacion" => $codigoReferenciaCatastral['codi_edificacion'],
    "tipo_edificacion" => $ubicacionPredioCatastral['tipo_edificacion'],
    "nomb_edificacion" => $ubicacionPredioCatastral['nomb_edificacion'],
    "clasificacion" => '',
  ];

  $edificacionRepository->guardarEdificacion($datosEdificacion);

  $datosUniCat = [
    "id_uni_cat" => trim($codigoReferenciaCatastral['codi_edificacion'] . $codigoReferenciaCatastral['codi_entrada'] . $codigoReferenciaCatastral['codi_piso'] . $codigoReferenciaCatastral['codi_unidad']),
    "id_lote" => $datosLote['id_lote'],
    "id_edificacion" => $datosEdificacion['id_edificacion'],
    "codi_entrada" => $codigoReferenciaCatastral['codi_entrada'],
    "codi_piso" => $codigoReferenciaCatastral['codi_piso'],
    "codi_unidad" => $codigoReferenciaCatastral['codi_unidad'],
    "tipo_interior" => $ubicacionPredioCatastral['tipo_interior'],
    "cuc" => "",
    "cuc_antecedente" => "",
    "codi_hoja_catastral" => "",
    "codi_pred_rentas" => "",
    "nume_interior" => $ubicacionPredioCatastral['nume_interior'],
    "unid_acum_rentas" => "",
    "codi_cont_rentas" => "",
  ];

  $uniCatRepository->guardarUniCat($datosUniCat);

  $datosFicha = [
    "id_ficha" => trim($anioActual . $codiUbigeo . $tipoFicha . $numeFicha),
    "tipo_ficha" => $tipoFicha,
    "nume_ficha" => $numeFicha,
    "id_lote" => $datosLote['id_lote'],
    "dc" => "",
    "nume_ficha_lote" => "",
    "declarante" => $dataPost['declarante']['dni'],
    "fecha_declarante" => $dataPost['declarante']['fecha_declarante'],
    "supervisor" => $dataPost['supervisor']['dni'],
    "fecha_supervision" => $dataPost['supervisor']['fecha'],
    "tecnico" => $dataPost['tecnico']['dni'],
    "fecha_levantamiento" => $dataPost['tecnico']['fecha'],
    "verificador" => $dataPost['verificador']['dni'],
    "fecha_verificacion" => $dataPost['verificador']['fecha'],
    "nume_registro" => $dataPost['verificador']['numeroRegistro'],
    "id_uni_cat" => $datosUniCat['id_uni_cat'],
    'id_usuario' => '0218011', // POR REVISAR################################################3
    'fecha_grabado' => date("Y-m-d"),
    "activo" => "1"
  ];

  $fichaRepository->guardarFicha($datosFicha);


  if (!$dataPost['declarante']['existe_declarante']) {
    $declaranteRepository->guardarDeclarante([
      "dni" => $dataPost['declarante']['dni'],
      "nombres" => $dataPost['declarante']['nombres'] ?? '',
      "ape_paterno" => $dataPost['declarante']['ape_paterno'] ?? '',
      "ape_materno" => $dataPost['declarante']['ape_materno'] ?? '',
      "fecha" => $dataPost['declarante']['fecha_declarante'],
      "id_ficha" => $datosFicha['id_ficha'],
    ]);
  }

  $datosFichaIndividual = [
    "id_ficha" => $datosFicha['id_ficha'],
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
    "nume_ficha" => $numeFicha
  ];

  $fichaIndividualRepository->guardarFichaIndividual($datosFichaIndividual);

  $sunarpRepository->guardarSunarp([
    "id_ficha" => $datosFicha['id_ficha'],
    "tipo_partida" => $dataPost['inscripcionPredioCatastral']['tipoPartida'] ?? '',
    "nume_partida" => $dataPost['inscripcionPredioCatastral']['numeroPartida'] ?? '',
    "fojas" => $dataPost['inscripcionPredioCatastral']['fojas'] ?? '',
    "asiento" => $dataPost['inscripcionPredioCatastral']['asiento'] ?? '',
    "fecha_inscripcion" => validarValor($dataPost['inscripcionPredioCatastral']['fechaInscripcion']),
    "codi_decla_fabrica" => $dataPost['inscripcionPredioCatastral']['codigoDeclaracionFabrica'] ?? '',
    "asie_fabrica" => $dataPost['inscripcionPredioCatastral']['asientoFabrica'] ?? '',
    "fecha_fabrica" => validarValor($dataPost['inscripcionPredioCatastral']['fechaFabrica']),
  ]);

  $datosTitulares = [];
  $datosDomicilioTitulares = [];

  if (count($dataPost['identificacionTitularCatastral']['personasNaturales']) > 0) {

    foreach ($dataPost['identificacionTitularCatastral']['personasNaturales'] as $personaNatural) {

      $datosPersonaNatural = [
        "id_persona" => trim($personaNatural['tipo'] . $personaNatural['tipoDocumento'] . $personaNatural['numeroDocumento']),
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

      $personaRepository->guardarPersona($datosPersonaNatural);

      array_push($datosTitulares, [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaNatural['id_persona'],
        "form_adquisicion" => $personaNatural['caracteristicas']['formaAdquisicion'],
        "fecha_adquisicion" => validarValor($personaNatural['caracteristicas']['fechaAdquisicion']),
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
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaNatural['id_persona'],
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

      $datosPersonaJuridica = [
        "id_persona" => trim($personaJuridica['tipo'] . $personaJuridica['tipoPersonaJuridica'] . $personaJuridica['ruc']),
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

      $personaRepository->guardarPersona($datosPersonaJuridica);

      array_push($datosTitulares, [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaJuridica['id_persona'],
        "form_adquisicion" => $personaJuridica['caracteristicas']['formaAdquisicion'],
        "fecha_adquisicion" => validarValor($personaJuridica['caracteristicas']['fechaAdquisicion']),
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
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaJuridica['id_persona'],
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
    $titularesRepository->guardarTitularesMultiple($datosTitulares);
  }

  if (count($datosDomicilioTitulares) > 0) {
    $domicilioTitularesRepository->guardarDomicilioTitularesMultiple($datosDomicilioTitulares);
  }

  $datosLitigantes = [];

  if (count($dataPost['litigantes']) > 0) {
    foreach ($dataPost['litigantes'] as $litigante) {
      $tipoPersonaPorDefecto = '1'; // Persona natural
      $tipoDocumentoPorDefecto = '02'; //DNI

      $datosPersonaLitigante = [
        "id_persona" => trim($tipoPersonaPorDefecto . $tipoDocumentoPorDefecto . $litigante['numero_documento']),
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

      $personaRepository->guardarPersona($datosPersonaLitigante);

      $datosLitigantes[] = [
        "id_ficha" => $datosFicha['id_ficha'],
        "id_persona" => $datosPersonaLitigante['id_persona'],
        "codi_contribuye" => $litigante['codigo_contribuyente'],
      ];
    }
  }

  if (count($datosLitigantes) > 0) {
    $litigantesRepository->guardarLitigantesMultiple($datosLitigantes);
  }

  $fichaCodigosAntiguosRepository->guardarFichaCodigosAntiguos([
    "id_ficha" => $datosFicha['id_ficha'],
    "codigo_catastral" => $dataPost['observaciones']['codigoCatastralAntiguo'],
  ]);


  $vias = $dataPost['puertasPredioCatastral'];
  $datosViasHUS = [];

  if (count($vias) > 0) {

    foreach ($vias as $via) {
      $datosPuertas = [];
      $idVia = $via['idVia'];

      array_push($datosViasHUS, [
        'id_hab_urba' => trim($ubicacionPredioCatastral['id_hab_urba']),
        'id_via' => trim($idVia)
      ]);

      foreach ($via['puertas'] as $puerta) {
        $datosPuerta = [
          'id_puerta' => trim($datosLote['id_lote'] . $puerta['codigo']),
          'id_lote' => trim($datosLote['id_lote']),
          'codi_puerta' => $puerta['codigo'],
          'tipo_puerta' => $puerta['tipo'],
          'nume_muni' => $puerta['numeroMunicipal'],
          'cond_nume' => $puerta['cond_nume'],
          'id_via' => trim($idVia),
          'nume_certificacion' => ''
        ];

        array_push($datosPuertas, $datosPuerta);
      }

      $puertasRepository->guardarPuertasMultiple($datosPuertas);

      $datosIngresos = [];

      foreach ($datosPuertas as $puertaIngresada) {
        array_push($datosIngresos, [
          'id_ficha' => $datosFicha['id_ficha'],
          'id_puerta' => $puertaIngresada['id_puerta']
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
  ]);


  $datosConstrucciones = [];

  if (count($dataPost['construcciones']) > 0) {
    foreach ($dataPost['construcciones'] as $construccion) {
      $datosConstruccion = [
        'id_construccion' => trim($datosFicha['id_ficha'] . $construccion['codigo']),
        'id_ficha' => $datosFicha['id_ficha'],
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

    $construccionesRepository->guardarConstruccionesMultiple($datosConstrucciones);
  }

  $datosInstalaciones = [];

  if (count($dataPost['obrasComplementarias']) > 0) {
    foreach ($dataPost['obrasComplementarias'] as $obraComplementaria) {
      array_push($datosInstalaciones, [
        'id_instalacion' => trim($datosFicha['id_ficha'] .  $obraComplementaria['codigo_instalacion'] . $obraComplementaria['correlativo']),
        'id_ficha' => trim($datosFicha['id_ficha']),
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

    $instalacionesRepository->guardarInstalacionesMultiple($datosInstalaciones);
  }

  $datosLindero = [
    'id_ficha' => $datosFicha['id_ficha'],
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

  $linderosRepository->guardarLinderos($datosLindero);

  //Guardar archivos
  if (isset($_FILES['archivos'])) {
    $archivos = $_FILES['archivos'];
    $archivosRepository->guardarArchivos($datosFicha['id_ficha'], $archivos);
  }

  $db->commit();

  createResponse(true, $datosFicha);

} catch (Exception $e) {
  $db->rollback();

  createResponse(false, [], $e->getMessage());
} finally {
  if (isset($db)) {
    $db->desconectar();
  }
}


function validarValor($valor)
{
  return !empty($valor) ? $valor : null;
}
