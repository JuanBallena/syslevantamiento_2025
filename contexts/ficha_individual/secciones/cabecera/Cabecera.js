class Cabecera {
  constructor() {
    this.inputNumeFicha = document.querySelector('[name="nume_ficha"]');
    this.inputIdUsuario = document.querySelector('[name="id_usuario"]');
    this.eventosLocales();

    this.inputIdUsuario.value = localStorage.getItem('numeral');
  }

  eventosLocales() {
    this.inputNumeFicha.addEventListener('input', async () => {
      const numeFicha = this.inputNumeFicha.value.trim();

      if (numeFicha.length === 7) {
        await this.buscarFicha(numeFicha);
      }
    });
  }

  async buscarFicha(numeFicha) {
    const data = await ServicioFicha.obtenerFichaPorNumero(numeFicha);

    if (data.success) {
      alert('La ficha ya existe. Por favor ingrese otro número de ficha.');

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
