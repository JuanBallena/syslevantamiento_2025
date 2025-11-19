class InscripcionPredio {
  static tipoPartiodas = [
    { value: '01', text: 'Tomo' },
    { value: '02', text: 'Ficha' },
    { value: '03', text: 'Partida de crédito' },
    { value: '04', text: 'Código de predio' },
  ];

  static decalaracionFabricaOpciones = [
    { value: '01', text: '01 - Fábrica inscrita' },
    { value: '02', text: '02 - Fábrica no inscrita' },
  ];

  constructor() {
    this.selectTipoPartida = document.querySelector('[name="tipo_partida"]');
    this.selectDeclaracionFabrica = document.querySelector('[name="codi_decla_fabrica"]');

    this.init();
  }

  init() {
    this.initSelectTipoPartida();
    this.initSelectDeclaracionFabrica();
  }

  initSelectTipoPartida() {
    new SelectDinamico({
      select: this.selectTipoPartida,
      data: InscripcionPredio.tipoPartiodas,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
    });
  }

  initSelectDeclaracionFabrica() {
    new SelectDinamico({
      select: this.selectDeclaracionFabrica,
      data: InscripcionPredio.decalaracionFabricaOpciones,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('inscripcion-predio');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  window.inscripcionPredio = new InscripcionPredio();
});
