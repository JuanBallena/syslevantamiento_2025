class ObrasComplementarias {
  constructor({ construccionesData }) {
    this.rowCount = 0;

    this.tbody = document.querySelector('#tabla-obras-complementarias tbody');
    this.template = document.querySelector('#filaTablaObrasComplementarias');

    this.codigosInstalaciones = [];
    this.tipoMateriales = construccionesData.tipoMateriales;
    this.tiposEcs = construccionesData.tiposEcs;
    this.tiposEcc = construccionesData.tiposEcc;
    this.tipoUcas = construccionesData.tipoUcas;

    this.init();

    document.addEventListener('click', function (e) {
      if (e.target.classList.contains('eliminar-fila-obra')) {
        const fila = e.target.closest('tr');
        if (fila) fila.remove();
      }
    });
  }

  async init() {
    await this.cargarCodigosInstalaciones();

    document.querySelector('#btn-add-row-obras').addEventListener('click', this.addRow.bind(this));
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

    const selectCodigoInst = newRow.querySelector('select[name="codi_instalacion"]');
    const descCodigoInst = newRow.querySelector('input[name="desc"]');
    const selectMEP = newRow.querySelector('select[name="mep"]');
    const selectECS = newRow.querySelector('select[name="ecs"]');
    const selectECC = newRow.querySelector('select[name="ecc"]');
    const selectTipoUca = newRow.querySelector('select[name="uca"]');

    new SelectDinamico({
      select: selectCodigoInst,
      data: this.codigosInstalaciones,
      label: (item) => `${item.codi_instalacion} - ${item.desc_instalacion}`,
      value: 'codi_instalacion',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        descCodigoInst.value = `${item.desc_instalacion}`;
      },
    });

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

    return formDataExtractor.obtenerDatosDesdeTabla('tabla-obras-complementarias');
  }
}
