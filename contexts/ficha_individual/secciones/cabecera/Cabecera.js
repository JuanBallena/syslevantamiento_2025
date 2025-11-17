class Cabecera {
  constructor() {
    this.numeFicha = document.querySelector('[name="nume_ficha"]');
    this.inicializarEventos();
  }

  inicializarEventos() {
    this.numeFicha.addEventListener('input', () => {
      const valor = this.numeFicha.value.trim();

      if (valor.length === 7) {
        this.buscarFicha(valor);
      }
    });
  }

  async buscarFicha(numeFicha) {
    const data = await ServicioFicha.buscarPorNumero(numeFicha);

    if (data.success) {
      alert(data.error);

      this.numeFicha.focus();
      this.numeFicha.select();
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new Cabecera();
});
