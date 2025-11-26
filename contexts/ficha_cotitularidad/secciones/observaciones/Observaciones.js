class Observaciones {
  //
  constructor() {
    //
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('observaciones');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  window.observaciones = new Observaciones();
});
