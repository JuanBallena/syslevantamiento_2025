class DomicilioTitular {
  static UbicacionOpciones = [
    { value: '01', text: '01 - Igual a UU.CC' },
    { value: '02', text: '02 - Otros' },
  ];

  constructor() {
    this.selectTipoUbicacion = document.querySelector('[name="tipo_ubicacion"]');

    this.selectCodiDep = document.querySelector('select[name="codi_dep"]');
    this.selectCodiPro = document.querySelector('select[name="codi_pro"]');
    this.selectCodiDis = document.querySelector('select[name="codi_dis"]');

    const domicilioTitular = document.querySelector('#domicilio-titular');
    this.inputNombHabUrba = domicilioTitular.querySelector('[name="nomb_hab_urba"]');
    this.inputIdHabUrba = domicilioTitular.querySelector('[name="id_hab_urba"]');
    this.inputCodiHabUrba = domicilioTitular.querySelector('[name="codi_hab_urba"]');

    this.departamentos = [];
    this.provincias = [];
    this.distritos = [];

    this.codiDep = null;

    this.init();
    this.initAutocompleteHabUrba();
  }

  async init() {
    this.initSelectTipoUbicacion();
    this.initSelectCodiDep();

    this.selectDistritos = new SelectDinamico({
      select: this.selectCodiDis,
      data: this.distritos,
      label: (item) => item.descri,
      value: 'codi_dis',
      defaultText: 'Seleccione',
    });

    this.selectProvincias = new SelectDinamico({
      select: this.selectCodiPro,
      data: this.provincias,
      label: (item) => item.descri,
      value: 'codi_pro',
      defaultText: 'Seleccione',
      onSelect: async (item) => {
        await this.initSelectCodiDisSegunCodiPro(item.codi_pro);
      },
    });
  }

  initSelectTipoUbicacion() {
    new SelectDinamico({
      select: this.selectTipoUbicacion,
      data: DomicilioTitular.UbicacionOpciones,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
    });
  }

  async initSelectCodiDep() {
    try {
      const res = await ServicioUbigeos.obtenerDepartamentos();

      if (res && res.success && Array.isArray(res.data)) {
        this.departamentos = res.data;
      } else {
        console.warn('ServicioUbigeos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener ubigeos:', err);
    }

    new SelectDinamico({
      select: this.selectCodiDep,
      data: this.departamentos,
      label: (item) => item.descri,
      value: 'codi_dep',
      defaultText: 'Seleccione',
      onSelect: async (item) => {
        this.selectProvincias.setData([]);
        this.selectDistritos.setData([]);

        await this.initSelectCodiProSegunCodiDep(item.codi_dep);
      },
    });
  }

  async initSelectCodiProSegunCodiDep(codi_dep) {
    try {
      this.codiDep = codi_dep;
      const res = await ServicioUbigeos.obtenerProvinciasSegunCodiDep(codi_dep);

      if (res && res.success && Array.isArray(res.data)) {
        this.provincias = res.data;
      } else {
        console.warn('ServicioUbigeos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener ubigeos:', err);
    }

    this.selectProvincias.setData(this.provincias);
  }
  async initSelectCodiDisSegunCodiPro(codi_pro) {
    try {
      const res = await ServicioUbigeos.obtenerDistritosSegunCodiPro(codi_pro, this.codiDep);

      if (res && res.success && Array.isArray(res.data)) {
        this.distritos = res.data;
      } else {
        console.warn('ServicioUbigeos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener ubigeos:', err);
    }

    this.selectDistritos.setData(this.distritos);
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
      input: this.inputCodiHabUrba,
      inputHidden: this.inputIdHabUrba,
      data: habilitacionesUrbanas,
      label: (item) => `${item.codi_hab_urba} - ${item.nomb_hab_urba}`,
      value: 'id_hab_urba',
      onSelect: (item) => {
        this.inputNombHabUrba.value = item.nomb_hab_urba;
      },
      onInput: () => {
        this.inputNombHabUrba.value = '';
      },
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('domicilio-titular');
  }
}
document.addEventListener('DOMContentLoaded', async () => {
  window.domicilioTitular = new DomicilioTitular();
});
