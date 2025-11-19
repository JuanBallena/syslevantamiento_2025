class ServiciosBasicos {
  constructor() {
    //
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('servicios-basicos');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  window.serviciosBasicos = new ServiciosBasicos();
});
