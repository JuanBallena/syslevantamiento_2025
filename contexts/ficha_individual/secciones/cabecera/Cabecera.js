class Cabecera {
  constructor() {
    this.inputNumeFicha = document.querySelector('[name="nume_ficha"]');
    this.eventosLocales();
  }

  eventosLocales() {
    this.inputNumeFicha.addEventListener('input', () => {
      const numeFicha = this.inputNumeFicha.value.trim();

      if (numeFicha.length === 7) {
        this.buscarFicha(numeFicha);
      }
    });
  }

  async buscarFicha(numeFicha) {
    const data = await ServicioFicha.obtenerFichaPorNumero(numeFicha);

    if (data.success) {
      this.inputNumeFicha.focus();
      this.inputNumeFicha.select();
    }
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('cabecera');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.cabecera = new Cabecera();
});
