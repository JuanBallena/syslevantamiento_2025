function validar_ceros(value) {
  if ((value = '')) {
    return 0;
  }
}

function loadInputValuesEvaluacionPredio(cantidadEnLote) {
  document.getElementById('input-lote-colid').value = cantidadEnLote;
}

function loadInputValuesEvaluacionPredio(cantidadEnAreaP) {
  document.getElementById('input-area-publica').value = cantidadEnAreaP;
}

function loadInputValuesEvaluacionPredio(cantidadEnJardin) {
  document.getElementById('input-jardin-aisla').value = cantidadEnJardin;
}

function loadInputValuesEvaluacionPredio(cantidadEnAreaI) {
  document.getElementById('input-area-intan').value = cantidadEnAreaI;
}
