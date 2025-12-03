class DescripcionPredio {
  constructor() {
    this.inputCodiUsoCodiDesc = document.querySelector('[name="codi_uso_codi_desc"]');
    this.inputCodiUso = document.querySelector('[name="codi_uso"]');
    this.inputDescUso = document.querySelector('[name="desc_uso"]');

    this.selectClasificacion = document.querySelector('[name="clasificacion"]');
    this.selectCondEn = document.querySelector('[name="cond_en"]');

    this.initAutocompleteUso();
    this.initSelectClasificacion();
    this.initSelectCondEn();
  }

  async initAutocompleteUso() {
    this.autocompleteUso = new Autocomplete({
      input: this.inputCodiUsoCodiDesc,
      inputHidden: this.inputCodiUso,
      data: [],
      label: (item) => `${item.codi_uso} - ${item.desc_uso}`,
      value: 'codi_uso',
      onSelect: (item) => {
        this.inputDescUso.value = item.desc_uso;
      },
    });

    this.inputCodiUsoCodiDesc.addEventListener('input', this.buscarUsos.bind(this));
  }

  async buscarUsos(e) {
    const codiUso = e.target.value.trim();

    if (codiUso.length < 1) {
      return;
    }

    try {
      const res = await ServicioUsos.obtenerUsosPorCodigo(codiUso);

      if (res.success && Array.isArray(res.data)) {
        this.autocompleteUso.updateData(res.data);
      } else {
        // this.autocompleteUso.updateData([]);
      }
    } catch (err) {
      console.error('Error al buscar usos:', err);
      this.autocompleteUso.updateData([]);
    }
  }

  async initSelectClasificacion() {
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
      select: this.selectClasificacion,
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
