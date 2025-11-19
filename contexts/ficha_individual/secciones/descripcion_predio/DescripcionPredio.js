class DescripcionPredio {
  constructor() {
    this.descUso = document.querySelector('[name="desc_uso"]');
    this.hiddenCodiUso = document.querySelector('[name="codi_uso"]');

    this.selectClasificacionPredio = document.querySelector('[name="clasificacion_predio"]');
    this.selectCondEn = document.querySelector('[name="cond_en"]');

    this.initAutocompleteUso();
    this.initSelectClasificacionPredio();
    this.initSelectCondEn();
  }

  initAutocompleteUso() {
    this.autocompleteUso = new Autocomplete({
      input: this.descUso,
      inputHidden: this.hiddenCodiUso,
      data: [], // inicia vacío
      label: (item) => `${item.desc_uso}`,
      value: 'codi_uso',
      onSelect: (item) => {
        // Tu lógica
      },
    });

    // Escuchar cuando el usuario escribe
    this.descUso.addEventListener('input', this.buscarUsos.bind(this));
  }

  async buscarUsos(e) {
    const texto = e.target.value.trim();

    if (texto.length < 2) {
      this.autocompleteUso.updateData([]);
      return;
    }

    try {
      const res = await ServicioUsos.obtenerUsosPorDescripcion(texto);

      if (res.success && Array.isArray(res.data)) {
        this.autocompleteUso.updateData(res.data);
      } else {
        this.autocompleteUso.updateData([]);
      }
    } catch (err) {
      console.error('Error al buscar usos:', err);
      this.autocompleteUso.updateData([]);
    }
  }

  async initSelectClasificacionPredio() {
    let clasificacionesPredios = [];

    try {
      const res = await ServicioClasificacionesPredios.obtenerClasificacionesPredios();
      if (res && res.success && Array.isArray(res.data)) {
        clasificacionesPredios = res.data;
      } else {
        console.warn('ServicioClasificacionesPredios: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener clasificaciones predios:', err);
    }

    new SelectDinamico({
      select: this.selectClasificacionPredio,
      data: clasificacionesPredios,
      label: (item) => item.c_desc_tipo_clasificacion,
      value: 'c_cod_tipo_clasificacion',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  async initSelectCondEn() {
    let prediosCatastrales = [];

    try {
      const res = await ServicioPrediosCatastrales.obtenerPrediosCatastrales();
      if (res && res.success && Array.isArray(res.data)) {
        prediosCatastrales = res.data;
      } else {
        console.warn('ServicioPrediosCatastrales: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener predios catastrales:', err);
    }

    new SelectDinamico({
      select: this.selectCondEn,
      data: prediosCatastrales,
      label: (item) => item.c_desc_predio_catastral,
      value: 'c_cod_predio_catastral',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('descripcion-predio');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.descripcionPredio = new DescripcionPredio();
});
