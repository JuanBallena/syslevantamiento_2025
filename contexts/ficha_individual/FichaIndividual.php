<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Ficha Catastral Urbana Individual</title>

    <link rel="stylesheet" href="styles.css" />

    <link href="../../assets/index.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="o-main max-h-screen px-20 bg-whit" style="overflow: auto">
      <form
        method="post"
        autocomplete="off"
        enctype="multipart/form-data"
        id="formulario-ficha-urbana-individual"
      >
        <div class="py-4 px-8 border-1-accent">
          <div class="text-center text-14 text-600 mb-8">Ficha Catastral Urbana Individual</div>

          <?php include 'secciones/cabecera/Cabecera.html' ?>
          <br>
          <?php include 'secciones/datos_generales/DatosGenerales.html' ?>
          <br>
          <?php include 'secciones/ubicacion_predio/UbicacionPredio.html' ?>
          <br>
          <?php include 'secciones/identificacion_titular/IdentificacionTitular.html' ?>
          <br>
          <?php include 'secciones/domicilio_titular/DomicilioTitular.html' ?>
          <br>
          <?php include 'secciones/caracteristicas_titularidad/CaracteristicasTitularidad.html' ?>
          <br>
          <?php include 'secciones/descripcion_predio/DescripcionPredio.html' ?>
          <br>
          <?php include 'secciones/servicios_basicos/ServiciosBasicos.html' ?>
          <br>
          <?php include 'secciones/construcciones/Construcciones.html' ?>
          <br>
          <?php include 'secciones/obras_complementarias/ObrasComplementarias.html' ?>
          <br>
          <?php include 'secciones/documentos/Documentos.html' ?>
          <br>
          <?php include 'secciones/inscripcion_predio/InscripcionPredio.html' ?>
          <br>
          <?php include 'secciones/evaluacion_predio/EvaluacionPredio.html' ?>
          <br>
          <?php include 'secciones/informacion_complementaria/InformacionComplementaria.html' ?>
          <br>
          <?php include 'secciones/observaciones/Observaciones.html' ?>
          <br>
          <?php include 'secciones/firmas/Firmas.html' ?>

          <div class="w-3-12">
            <div class="grid grid-cols-2 gap-x-1 mb-4">
              <button class="a-btn btn-accent">Cancelar</button>
              <button type="submit" class="a-btn btn-success">Grabar</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <script type="text/javascript" src="./../_shared/ApiConfig.js"></script>
    <script type="text/javascript" src="./../_shared/ValidadorGenerico.js"></script>
    <script type="text/javascript" src="./../_shared/Autocomplete.js"></script>
    <script type="text/javascript" src="./../_shared/SelectDinamico.js"></script>
    <script type="text/javascript" src="./../_shared/Helper.js"></script>
    <script type="text/javascript" src="./../_shared/FormBackup.js"></script>
    <script type="text/javascript" src="./../_shared/FormDataExtractor.js"></script>

    <!-- SERVICES -->
    <script type="text/javascript" src="./../_services/BaseServicio.js"></script>
    <script type="text/javascript" src="./../_services/ServicioFicha.js"></script>
    <script type="text/javascript" src="./../_services/ServicioSectores.js"></script>
    <script type="text/javascript" src="./../_services/ServicioManzanas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTipoEdificaciones.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTipoInteriores.js"></script>
    <script type="text/javascript" src="./../_services/ServicioHabilitacionesUrbanas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioVias.js"></script>
    <script type="text/javascript" src="./../_services/ServicioUsos.js"></script>
    <script type="text/javascript" src="./../_services/ServicioClasificacionesPredios.js"></script>
    <script type="text/javascript" src="./../_services/ServicioPrediosCatastrales.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTipoMateriales.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTipoCategorias.js"></script>
    <script type="text/javascript" src="./../_services/ServicioCodigosInstalaciones.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTipoDocumentos.js"></script>
    <script type="text/javascript" src="./../_services/ServicioNotarias.js"></script>
    <script type="text/javascript" src="./../_services/ServicioEstadosFichas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioMantenimientos.js"></script>
    <script type="text/javascript" src="./../_services/ServicioCondicionesDeclarantes.js"></script>
    <script type="text/javascript" src="./../_services/ServicioPersonas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioDeclarantes.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTiposEcc.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTiposEcs.js"></script>
    <script type="text/javascript" src="./../_services/ServicioTipoUcas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioUbigeos.js"></script>

    <!-- SECCIONES -->
    <script type="text/javascript" src="./../ficha_individual/secciones/cabecera/Cabecera.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/datos_generales/DatosGenerales.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/ubicacion_predio/UbicacionPredio.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/ubicacion_predio/Vias.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/ubicacion_predio/Puertas.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/identificacion_titular/IdentificacionTitular.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/identificacion_titular/FormularioPersonaNatural.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/identificacion_titular/FormularioPersonaJuridica.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/identificacion_titular/FormularioConyugue.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/domicilio_titular/DomicilioTitular.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/caracteristicas_titularidad//CaracteristicasTitularidad.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/descripcion_predio/DescripcionPredio.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/servicios_basicos/ServiciosBasicos.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/obras_complementarias/ObrasComplementarias.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/construcciones/Construcciones.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/documentos/Documentos.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/inscripcion_predio/InscripcionPredio.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/evaluacion_predio/EvaluacionPredio.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/informacion_complementaria/InformacionComplementaria.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/observaciones/Observaciones.js"></script>
    <script type="text/javascript" src="./../ficha_individual/secciones/firmas/Firmas.js"></script>

    <script type="text/javascript" src="./../ficha_individual/ControladorFichaUrbanaIndividual.js"></script>

  </body>
</html>