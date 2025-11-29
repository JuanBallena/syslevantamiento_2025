class Cabecera {
  constructor() {
    const contenedor = document.getElementById('cabecera');
    this.numeFicha = contenedor.querySelector('[name="nume_ficha"]');
    this.inicializarEventos();
  }

  inicializarEventos() {
    this.numeFicha.addEventListener('input', () => {
      console.log('khe');
      const valor = this.numeFicha.value.trim();

      if (valor.length === 7) {
        this.buscarFicha(valor);
      }
    });
  }

  async buscarFicha(numeFicha) {
    const data = await ServicioFicha.obtenerFichaPorNumero(numeFicha);

    if (data.success) {
      alert(data.error);

      this.numeFicha.focus();
      this.numeFicha.select();
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
