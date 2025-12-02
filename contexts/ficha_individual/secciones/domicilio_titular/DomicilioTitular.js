class DomicilioTitular {
  static UbicacionOpciones = [
    { value: '01', text: '01 - Igual a UU.CC' },
    { value: '02', text: '02 - Otros' },
  ];

  constructor() {
    const domicilioTitular = document.querySelector('#domicilio-titular');
    this.selectTipoUbicacion = domicilioTitular.querySelector('[name="tipo_ubicacion"]');

    this.selectCodiDep = domicilioTitular.querySelector('select[name="codi_dep"]');
    this.selectCodiPro = domicilioTitular.querySelector('select[name="codi_pro"]');
    this.selectCodiDis = domicilioTitular.querySelector('select[name="codi_dis"]');

    this.inputNombHabUrba = domicilioTitular.querySelector('[name="nomb_hab_urba"]');
    this.inputIdHabUrba = domicilioTitular.querySelector('[name="id_hab_urba"]');
    this.inputCodiHabUrba = domicilioTitular.querySelector('[name="codi_hab_urba"]');

    this.inputNombVia = domicilioTitular.querySelector('[name="nomb_via"]');
    this.inputIdVia = domicilioTitular.querySelector('[name="id_via"]');
    this.inputTipoVia = domicilioTitular.querySelector('[name="tipo_via"]');
    this.inputCodiVia = domicilioTitular.querySelector('[name="codi_via"]');

    this.inputNumeInterior = domicilioTitular.querySelector('[name="nume_interior"]');
    this.inputZonaSectorEtapa = domicilioTitular.querySelector('[name="zona_sector_etapa"]');
    this.inputMzna = domicilioTitular.querySelector('[name="mzna"]');
    this.inputLote = domicilioTitular.querySelector('[name="lote"]');
    this.inputSublote = domicilioTitular.querySelector('[name="sublote"]');
    this.inputNumeMuni = domicilioTitular.querySelector('[name="nume_muni"]');

    this.departamentos = [];
    this.provincias = [];
    this.distritos = [];

    this.codiDep = null;
    this.vias = [];

    this.init();
    this.initAutocompleteHabUrba();
    this.initAutocompleteCodiVia();
    this.initSelectTipoUbicacion();
    this.initSelectCodiDep();
    this.initEventosLocales();
  }

  async init() {
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

  async initAutocompleteCodiVia() {
    try {
      const res = await ServicioVias.obtenerVias();
      if (res && res.success && Array.isArray(res.data)) {
        this.vias = res.data;
      } else {
        console.warn('ServicioVias: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener vias:', err);
    }

    new Autocomplete({
      input: this.inputCodiVia,
      inputHidden: this.inputIdVia,
      data: this.vias,
      label: (item) => `${item.codi_via} - ${item.nomb_via}`,
      value: 'id_via',
      onSelect: (item) => {
        this.inputNombVia.value = item.nomb_via;
        this.inputTipoVia.value = item.tipo_via;
      },
      onInput: () => {
        this.inputNombVia.value = '';
        this.inputTipoVia.value = '';
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

  initEventosLocales() {
    this.selectTipoUbicacion.addEventListener('change', (e) => this.manejarTipoUbicacion(e));
    this.selectCodiDis.addEventListener('change', () => this.actualizarVia());
    this.selectCodiPro.addEventListener('change', () => this.actualizarVia());
    this.selectCodiDep.addEventListener('change', () => this.actualizarVia());
  }

  async manejarTipoUbicacion(e) {
    const tipoUbicacion = e.target.value;
    const ubicacionPredioData = window.ubicacionPredio.getData();

    console.log(ubicacionPredioData);

    if (tipoUbicacion === '01') {
      this.inputCodiHabUrba.value = ubicacionPredioData.codi_hab_urba || '';
      this.inputIdHabUrba.value = ubicacionPredioData.id_hab_urba || '';
      this.inputNombHabUrba.value = ubicacionPredioData.nomb_hab_urba || '';
      this.inputNumeInterior.value = ubicacionPredioData.nume_interior || '';
      this.inputNumeInterior.value = ubicacionPredioData.nume_interior || '';
      this.inputZonaSectorEtapa.value = ubicacionPredioData.zona_sector_etapa || '';
      this.inputMzna.value = ubicacionPredioData.mzna_dist || '';
      this.inputLote.value = ubicacionPredioData.lote_dist || '';
      this.inputSublote.value = ubicacionPredioData.sub_lote_dist || '';

      this.selectCodiDep.disabled = true;
      this.selectCodiPro.disabled = true;
      this.selectCodiDis.disabled = true;

      this.selectCodiDep.value = '13';
      await this.initSelectCodiProSegunCodiDep('13');
      this.selectCodiPro.value = '01';
      await this.initSelectCodiDisSegunCodiPro('01');
      this.selectCodiDis.value = '01';

      if (ubicacionPredioData.vias.length > 0) {
        const via = ubicacionPredioData.vias[0];

        this.inputCodiVia.value = via.codi_via || '';
        this.inputTipoVia.value = via.tipo_via || '';
        this.inputNombVia.value = via.nomb_via || '';

        if (via.puertas.length > 0) {
          const puerta = via.puertas[0];
          this.inputNumeMuni.value = puerta.nume_muni || '';
        }
      }
    }

    if (tipoUbicacion === '02') {
      this.inputCodiHabUrba.value = '';
      this.inputIdHabUrba.value = '';
      this.inputNombHabUrba.value = '';
      this.inputNumeInterior.value = '';
      this.inputNumeInterior.value = '';
      this.inputZonaSectorEtapa.value = '';
      this.inputMzna.value = '';
      this.inputLote.value = '';
      this.inputSublote.value = '';

      this.selectCodiDep.disabled = false;
      this.selectCodiPro.disabled = false;
      this.selectCodiDis.disabled = false;

      this.selectCodiDep.value = '13';
      await this.initSelectCodiProSegunCodiDep('13');
      this.selectCodiPro.value = '01';
      await this.initSelectCodiDisSegunCodiPro('01');
      this.selectCodiDis.value = '01';
    }

    this.actualizarVia();
  }

  actualizarVia() {
    this.inputCodiVia.disabled = false;

    const tipoUbicacion = this.selectTipoUbicacion.value;
    const codiDis = this.selectCodiDis.value;
    const codiPro = this.selectCodiPro.value;
    const codiDep = this.selectCodiDep.value;

    if (tipoUbicacion === '02') {
      if (codiDep === '13' && codiPro === '01' && codiDis === '01') {
        this.inputCodiVia.value = '';
        this.inputCodiVia.disabled = false;
        this.inputIdVia.value = '';
        this.inputTipoVia.value = '';
        this.inputNombVia.value = '';
      } else {
        this.inputCodiVia.value = '999999';
        this.inputCodiVia.disabled = true;
        this.inputIdVia.value = '';
        this.inputTipoVia.value = 'Calle';
        this.inputNombVia.value = '';
      }

      if (tipoUbicacion === '02') {
        this.inputNumeMuni.disabled = true;
      } else {
        this.inputNumeMuni.disabled = false;
      }
    }
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
