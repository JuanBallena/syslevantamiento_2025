<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Ficha Cotitularidad</title>

    <link rel="stylesheet" href="../../assets/styles.css" />
    <link rel="stylesheet" href="../../assets/index.css"/>
  </head>
  <body>
    <div class="o-main max-h-screen px-10 bg-whit" style="overflow: auto">
      <div class="py-4 px-8 border-1-accent">
        <div class="text-center text-14 text-600 mb-8">Ficha Cotitularidad</div>

        <?php include 'secciones/buscar_ficha/BuscarFicha.html' ?>

        <div class="none" id="contenedor-formulario-ficha-cotitularidad">
          <form
            method="post"
            autocomplete="off"
            enctype="multipart/form-data"
            id="formulario-ficha-cotitularidad"
          >
            <?php include 'secciones/cabecera/Cabecera.html' ?>
            <br>
            <?php include 'secciones/datos_generales/DatosGenerales.html' ?>
            <br>
<!-- ubicacion predio -->
            <?php include 'secciones/identificacion_titular/IdentificacionTitular.html' ?>
            <br>
            <?php include 'secciones/domicilio_titular/DomicilioTitular.html' ?>
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
    </div>

    <script type="text/javascript" src="./../_shared/ApiConfig.js"></script>
    <script type="text/javascript" src="./../_shared/ValidadorGenerico.js"></script>
    <script type="text/javascript" src="./../_shared/Autocomplete.js"></script>
    <script type="text/javascript" src="./../_shared/SelectDinamico.js"></script>
    <script type="text/javascript" src="./../_shared/Helper.js"></script>
    <!-- <script type="text/javascript" src="./../_shared/FormBackup.js"></script> -->
    <script type="text/javascript" src="./../_shared/FormDataExtractor.js"></script>

    <!-- SERVICES -->
    <script type="text/javascript" src="./../_services/BaseServicio.js"></script>
    <script type="text/javascript" src="./../_services/ServicioFicha.js"></script>
    <script type="text/javascript" src="./../_services/ServicioSectores.js"></script>
    <script type="text/javascript" src="./../_services/ServicioManzanas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioHabilitacionesUrbanas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioEstadosFichas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioMantenimientos.js"></script>
    <script type="text/javascript" src="./../_services/ServicioCondicionesDeclarantes.js"></script>
    <script type="text/javascript" src="./../_services/ServicioPersonas.js"></script>
    <script type="text/javascript" src="./../_services/ServicioDeclarantes.js"></script>
     <script type="text/javascript" src="./../_services/ServicioUbigeos.js"></script>

    <!-- SECCIONES -->
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/cabecera/Cabecera.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/datos_generales/DatosGenerales.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/buscar_ficha/BuscarFicha.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/identificacion_titular/IdentificacionTitular.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/identificacion_titular/FormularioPersonaNatural.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/identificacion_titular/FormularioPersonaJuridica.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/identificacion_titular/FormularioConyugue.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/domicilio_titular/DomicilioTitular.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/informacion_complementaria/InformacionComplementaria.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/observaciones/Observaciones.js"></script>
    <script type="text/javascript" src="./../ficha_cotitularidad/secciones/firmas/Firmas.js"></script>

    <script type="text/javascript" src="./../ficha_cotitularidad/ControladorFichaUrbanaCotitularidad.js"></script>

  </body>
</html>