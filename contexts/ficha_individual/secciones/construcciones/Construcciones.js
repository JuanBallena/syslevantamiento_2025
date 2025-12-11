class Construcciones {
  constructor() {
    this.tipoMateriales = [];
    this.tiposEcs = [];
    this.tiposEcc = [];
    this.tipoCategorias = [];
    this.tipoUcas = [];

    this.rowCount = 0;
    this.tbody = document.querySelector('#tabla-construcciones tbody');
    this.template = document.querySelector('#filaTemplateConstruccion');

    // this.init();
  }

  async init() {
    await this.cargarTiposMateriales();
    await this.cargarTiposEcs();
    await this.cargarTiposEcc();
    await this.cargarTipoCategorias();
    await this.cargarTipoUcas();

    document.querySelector('#btn-add-row').addEventListener('click', this.addRow.bind(this));

    document.addEventListener('click', function (e) {
      if (e.target.classList.contains('eliminar-fila-construccion')) {
        const fila = e.target.closest('tr');
        if (fila) fila.remove();
      }
    });
  }

  getTipoCategorias() {
    return this.tipoCategorias;
  }

  async cargarTiposMateriales() {
    try {
      const res = await ServicioTipoMateriales.obtenerTipoMateriales();

      if (res && res.success && Array.isArray(res.data)) {
        this.tipoMateriales = res.data;
      } else {
        console.warn('ServicioTipoMateriales: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo materiales:', err);
    }
  }

  async cargarTiposEcs() {
    try {
      const res = await ServicioTiposEcs.obtenerTiposEcs();

      if (res && res.success && Array.isArray(res.data)) {
        this.tiposEcs = res.data;
      } else {
        console.warn('ServicioTiposEcs: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipos ecs:', err);
    }
  }

  async cargarTiposEcc() {
    try {
      const res = await ServicioTiposEcc.obtenerTiposEcc();

      if (res && res.success && Array.isArray(res.data)) {
        this.tiposEcc = res.data;
      } else {
        console.warn('ServicioTiposEcc: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipos ecc:', err);
    }
  }

  async cargarTipoCategorias() {
    try {
      const res = await ServicioTipoCategorias.obtenerTipoCategorias();

      if (res && res.success && Array.isArray(res.data)) {
        this.tipoCategorias = res.data;
      } else {
        console.warn('ServicioTipoCategorias: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo categorías:', err);
    }
  }

  async cargarTipoUcas() {
    try {
      const res = await ServicioTipoUcas.obtenerTipoUcas();

      if (res && res.success && Array.isArray(res.data)) {
        this.tipoUcas = res.data;
      } else {
        console.warn('ServicioTipoUcas: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo ucas:', err);
    }
  }

  addRow() {
    this.rowCount++;
    const clone = this.template.content.cloneNode(true);

    // Asignar IDs únicos
    clone.querySelectorAll('select, input').forEach((input, index) => {
      input.id = `fila${this.rowCount}_col${index + 1}`;
    });

    // Insertar fila en la tabla
    this.tbody.appendChild(clone);

    // Obtener la fila recién agregada
    const newRow = this.tbody.lastElementChild;

    // Obtener selects por name
    const selectMEP = newRow.querySelector('select[name="mep"]');
    const selectECS = newRow.querySelector('select[name="ecs"]');
    const selectECC = newRow.querySelector('select[name="ecc"]');
    const selectTipoUca = newRow.querySelector('select[name="uca"]');

    new SelectDinamico({
      select: selectMEP,
      data: this.tipoMateriales,
      label: (item) => `${item.i_cod_tip_material} - ${item.c_des_tip_material}`,
      value: 'i_cod_tip_material',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectECS,
      data: this.tiposEcs,
      label: (item) => `${item.i_cod_tip_ecs} - ${item.c_des_tip_ecs}`,
      value: 'i_cod_tip_ecs',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectECC,
      data: this.tiposEcc,
      label: (item) => `${item.i_cod_tip_ecc} - ${item.c_des_tip_ecc}`,
      value: 'i_cod_tip_ecc',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectTipoUca,
      data: this.tipoUcas,
      label: (item) => `${item.i_cod_tip_uca} - ${item.c_des_tip_uca}`,
      value: 'i_cod_tip_uca',
      defaultText: 'Seleccione',
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeTabla('tabla-construcciones');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  const construcciones = new Construcciones();
  await construcciones.init();

  const obrasComplementarias = new ObrasComplementarias({
    construccionesData: construcciones,
  });

  window.construcciones = construcciones;
  window.obrasComplementarias = obrasComplementarias;
});
