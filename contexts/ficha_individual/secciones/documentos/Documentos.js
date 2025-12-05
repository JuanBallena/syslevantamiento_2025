class Documentos {
  constructor() {
    // Datos cargados desde servicios
    // this.selectNotaria = document.querySelector('select[name="notaria"]');
    this.tipoDocumentos = [];
    this.notarias = [];

    // Tabla
    this.rowCount = 0;
    this.tbody = document.querySelector('#tabla-documentos tbody');
    this.template = document.querySelector('#filaTemplateDocumento');

    // Iniciar todo
    this.init();
  }

  async init() {
    await this.cargarTipoDocumentos();
    // await this.initSelectNotaria();

    document
      .querySelector('#agregar-fila-documento')
      .addEventListener('click', this.addRow.bind(this));
  }

  // async initSelectNotaria() {
  //   try {
  //     const res = await ServicioNotarias.obtenerNotarias();

  //     if (res && res.success && Array.isArray(res.data)) {
  //       this.notarias = res.data;
  //     } else {
  //       console.warn('ServicioTipoDocumentos: respuesta inválida', res);
  //     }
  //   } catch (err) {
  //     console.error('Error al obtener tipo documentos:', err);
  //   }

  //   new SelectDinamico({
  //     select: this.selectNotaria,
  //     data: this.notarias,
  //     label: (item) => item.nomb_notaria,
  //     value: 'id_notaria',
  //     defaultText: 'Seleccione',
  //   });
  // }

  async cargarTipoDocumentos() {
    try {
      const res = await ServicioTipoDocumentos.obtenerTipoDocumentos();

      if (res && res.success && Array.isArray(res.data)) {
        this.tipoDocumentos = res.data;
      } else {
        console.warn('ServicioTipoDocumentos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo documentos:', err);
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
    const selectTipoDocumento = newRow.querySelector('select[name="tipo_doc"]');

    new SelectDinamico({
      select: selectTipoDocumento,
      data: this.tipoDocumentos,
      label: (item) => item.c_des_tip_documento,
      value: 'i_cod_tip_documento',
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    // return {
    //   registroNotarial: formDataExtractor.obtenerDatosDesdeContenedor('documentos'),
    //   lista: formDataExtractor.obtenerDatosDesdeTabla('tabla-documentos'),
    // };
    return formDataExtractor.obtenerDatosDesdeTabla('tabla-documentos');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  window.documentos = new Documentos();
});
