class EvaluacionPredio {
  constructor() {
    //
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('evaluacion-predio');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.evaluacionPredio = new EvaluacionPredio();
});
