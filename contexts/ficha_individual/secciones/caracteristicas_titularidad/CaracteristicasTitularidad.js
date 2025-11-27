class CaracteristicasTitularidad {
  static condicionesTitulares = [
    { value: '01', text: 'Propietario Único' },
    { value: '02', text: 'Sucesión intestada' },
    { value: '03', text: 'Poseedor' },
    { value: '04', text: 'Sociedad Conyugal' },
    { value: '05', text: 'Cotitularidad' },
    { value: '06', text: 'Litigio' },
    { value: '07', text: 'Otros' },
  ];

  static formasAdquisiciones = [
    { value: '01', text: 'Compra Venta' },
    { value: '02', text: 'Antic Legitima' },
    { value: '03', text: 'Testamento' },
    { value: '04', text: 'Donación' },
    { value: '05', text: 'Adjudicación' },
    { value: '06', text: 'Fusión' },
    { value: '07', text: 'Expropiación' },
    { value: '08', text: 'Permuta' },
    { value: '09', text: 'Prescripción Adqui' },
    { value: '10', text: 'Ces. Der/Acciones' },
    { value: '11', text: 'Dacion pago' },
    { value: '12', text: 'Decl. Herederos' },
    { value: '13', text: 'Posesion' },
    { value: '14', text: 'Otros' },
  ];

  static condEspPredioOpciones = [
    { value: '01', text: 'Monumento Histórico' },
    { value: '02', text: 'Predio Rústico' },
    { value: '03', text: 'Sistema de ayuda de Aeronavegación' },
  ];

  constructor() {
    this.selectCondicionTitular = document.querySelector('[name="cond_titular"]');
    this.selectFormaAdquisicion = document.querySelector('[name="form_adquisicion"]');
    // this.selectCondEspPredio = document.querySelector('[name="cond_esp_predio"]');

    this.initSelectCondicionTitular();
    this.initSelectFormaAdquisicion();
    // this.initSelectCondEspPredio();
  }

  initSelectCondicionTitular() {
    new SelectDinamico({
      select: this.selectCondicionTitular,
      data: CaracteristicasTitularidad.condicionesTitulares,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  initSelectFormaAdquisicion() {
    new SelectDinamico({
      select: this.selectFormaAdquisicion,
      data: CaracteristicasTitularidad.formasAdquisiciones,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  // initSelectCondEspPredio() {
  //   new SelectDinamico({
  //     select: this.selectCondEspPredio,
  //     data: CaracteristicasTitularidad.condEspPredioOpciones,
  //     label: (item) => `${item.value} - ${item.text}`,
  //     value: 'value',
  //     defaultText: 'Seleccione',
  //     onSelect: (item) => {
  //       //
  //     },
  //   });
  // }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('caracteristicas-titularidad');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.caracteristicasTitularidad = new CaracteristicasTitularidad();
});
