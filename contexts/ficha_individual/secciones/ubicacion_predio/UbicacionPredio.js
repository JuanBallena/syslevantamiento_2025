class UbicacionPredio {
  constructor() {
    this.selectTipoEdificacion = document.querySelector('[name="tipo_edificacion"]');
    this.selectTipoInteriores = document.querySelector('[name="tipo_interior"]');

    this.inputHabUrba = document.querySelector('[name="nomb_hab_urba"]');
    this.hiddenHabUrba = document.querySelector('[name="id_hab_urba"]');
    this.codiHabUrba = document.querySelector('[name="codi_hab_urba"]');

    this.initSelectTipoEdificacion();
    this.initSelectTipoInterior();
    this.initAutocompleteHabUrba();
  }

  async initSelectTipoEdificacion() {
    let tipoEdificaciones = [];

    try {
      const res = await ServicioTipoEdificaciones.obtenerTipoEdificaciones();
      if (res && res.success && Array.isArray(res.data)) {
        tipoEdificaciones = res.data;
      } else {
        console.warn('ServicioTipoEdificaciones: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo edificaciones:', err);
    }

    new SelectDinamico({
      select: this.selectTipoEdificacion,
      data: tipoEdificaciones,
      label: (item) => item.c_des_tip_edificacion,
      value: 'i_cod_tip_edificacion',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  async initSelectTipoInterior() {
    let tipoInteriores = [];

    try {
      const res = await ServicioTipoInteriores.obtenerTipoInteriores();
      if (res && res.success && Array.isArray(res.data)) {
        tipoInteriores = res.data;
      } else {
        console.warn('ServicioTipoInteriores: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo interiores:', err);
    }

    new SelectDinamico({
      select: this.selectTipoInteriores,
      data: tipoInteriores,
      label: (item) => item.c_des_tip_interior,
      value: 'i_cod_tip_interior',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  async initAutocompleteHabUrba() {
    let habilitacionesUrbanas = [];

    try {
      const res = await ServicioHabilitacionesUrbanas.obtenerHabilitacionesUrbanas();
      if (res && res.success && Array.isArray(res.data)) {
        habilitacionesUrbanas = res.data;
      } else {
        console.warn('ServicioHabilitacionesUrbanas: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener habilitaciones urbanas:', err);
    }

    new Autocomplete({
      input: this.inputHabUrba,
      inputHidden: this.hiddenHabUrba,
      data: habilitacionesUrbanas,
      label: (item) => `${item.nomb_hab_urba}`,
      value: 'id_hab_urba',
      onSelect: (item) => {
        this.codiHabUrba.value = item.codi_hab_urba;
      },
      onInput: () => {
        this.codiHabUrba.value = '';
      },
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    const vias = formDataExtractor.obtenerDatosDesdeDataset(
      'contenedor-vias',
      '[data-via]',
      '[data-puerta]'
    );

    return {
      ...formDataExtractor.obtenerDatosDesdeContenedor('ubicacion-predio'),
      vias: vias,
    };
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.ubicacionPredio = new UbicacionPredio();
});
