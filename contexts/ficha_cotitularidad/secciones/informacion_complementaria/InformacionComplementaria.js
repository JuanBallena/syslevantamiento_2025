class InformacionComplementaria {
  constructor() {
    this.selectCondicionDeclarante = document.querySelector('[name="cond_declarante"]');
    this.selectEstadoFicha = document.querySelector('[name="esta_llenado"]');
    this.selectMantenimiento = document.querySelector('[name="mantenimiento"]');

    // Tabla Litigantes
    this.rowLitigantes = 0;
    this.tbodyLitigantes = document.querySelector('#tabla-litigantes tbody');
    this.templateLitigantes = document.querySelector('#filaTablaLitigantes');

    this.init();
  }

  async init() {
    await this.initSelectCondicionDeclarante();
    await this.initSelectEstadoFicha();
    await this.initSelectMantenimientos();

    document
      .querySelector('#boton-agregar-litigante')
      .addEventListener('click', this.addRowLitigante.bind(this));
  }

  async initSelectCondicionDeclarante() {
    try {
      const res = await ServicioCondicionesDeclarantes.obtenerCondicionesDeclarantes();
      this.condiciones = res.data ?? [];

      new SelectDinamico({
        select: this.selectCondicionDeclarante,
        data: this.condiciones,
        label: (i) => i.c_desc_tipo_condicion,
        value: 'c_cod_tipo_condicion',
        defaultText: 'Seleccione',
      });
    } catch (err) {
      console.error('Error cargando condiciones declarantes:', err);
    }
  }

  async initSelectEstadoFicha() {
    try {
      const res = await ServicioEstadosFichas.obtenerEstadosFichas();
      this.estadosFicha = res.data ?? [];

      new SelectDinamico({
        select: this.selectEstadoFicha,
        data: this.estadosFicha,
        label: (i) => i.c_desc_estado_ficha,
        value: 'c_cod_estado_ficha',
        defaultText: 'Seleccione',
      });
    } catch (err) {
      console.error('Error cargando estados de fichas:', err);
    }
  }

  async initSelectMantenimientos() {
    try {
      const res = await ServicioMantenimientos.obtenerMantenimientos();
      this.mantenimientos = res.data ?? [];

      new SelectDinamico({
        select: this.selectMantenimiento,
        data: this.mantenimientos,
        label: (i) => i.c_desc_mantenimiento,
        value: 'c_cod_mantenimiento',
        defaultText: 'Seleccione',
      });
    } catch (err) {
      console.error('Error cargando mantenimientos:', err);
    }
  }

  addRowLitigante() {
    this.rowLitigantes++;
    const clone = this.templateLitigantes.content.cloneNode(true);

    clone.querySelectorAll('input, select').forEach((input, index) => {
      input.id = `fila${this.rowLitigantes}_col${index + 1}`;
    });

    this.tbody.appendChild(clone);

    // Obtener la fila recién agregada
    const newRow = this.tbody.lastElementChild;

    const selectTipoDocumento = newRow.querySelector('[name="tipo_docu"]');

    new SelectDinamico({
      select: selectTipoDocumento,
      data: FormularioPersonaNatural.tipoDocumentos,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return {
      ...formDataExtractor.obtenerDatosDesdeContenedor('informacion-complementaria'),
      litigantes: formDataExtractor.obtenerDatosDesdeTabla('tabla-litigantes'),
    };
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.informacionComplementaria = new InformacionComplementaria();
});
