class ObrasComplementarias {
  constructor() {
    this.rowCount = 0;

    this.tbody = document.querySelector('#tabla-obras-complementarias tbody');
    this.template = document.querySelector('#filaTablaObrasComplementarias');

    this.codigosInstalaciones = [];
    this.tipoMateriales = [];

    this.init();
  }

  async init() {
    await this.cargarTiposMateriales();
    await this.cargarCodigosInstalaciones();

    document.querySelector('#btn-add-row-obras').addEventListener('click', this.addRow.bind(this));
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

  async cargarCodigosInstalaciones() {
    try {
      const res = await ServicioCodigosInstalaciones.obtenerCodigosInstalaciones();

      if (res && res.success && Array.isArray(res.data)) {
        this.codigosInstalaciones = res.data;
      } else {
        console.warn('ServicioCodigosInstalaciones: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al cargar codigos instalaciones:', err);
    }
  }

  addRow() {
    this.rowCount++;

    const clone = this.template.content.cloneNode(true);

    clone.querySelectorAll('select, input').forEach((input, index) => {
      input.id = `fila_obras_${this.rowCount}_col${index + 1}`;
    });

    this.tbody.appendChild(clone);

    const newRow = this.tbody.lastElementChild;

    const selectCodigoInst = newRow.querySelector('select[name="codigo_instalacion"]');
    const selectMEP = newRow.querySelector('select[name="mep"]');
    const selectECS = newRow.querySelector('select[name="ecs"]');
    const selectECC = newRow.querySelector('select[name="ecc"]');

    new SelectDinamico({
      select: selectCodigoInst,
      data: this.codigosInstalaciones,
      label: (item) => item.desc_instalacion,
      value: 'codi_instalacion',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectMEP,
      data: this.tipoMateriales,
      label: (item) => item.c_des_tip_material,
      value: 'i_cod_tip_material',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectECS,
      data: this.tipoMateriales,
      label: (item) => item.c_des_tip_material,
      value: 'i_cod_tip_material',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectECC,
      data: this.tipoMateriales,
      label: (item) => item.c_des_tip_material,
      value: 'i_cod_tip_material',
      defaultText: 'Seleccione',
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeTabla('tabla-obras-complementarias');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  window.obrasComplementarias = new ObrasComplementarias();
});
