class Construcciones {
  constructor() {
    // SELECTS GENERALES PARA SELECT DINÁMICO
    this.selectTipoMaterialGeneral = document.querySelector('[name="tipo_material_general"]');
    this.selectTipoCategoriaGeneral = document.querySelector('[name="tipo_categoria_general"]');

    // Datos cargados desde servicios
    this.tipoMateriales = [];
    this.tipoCategorias = [];

    // Tabla
    this.rowCount = 0;
    this.tbody = document.querySelector('#tabla-construcciones tbody');
    this.template = document.querySelector('#filaTemplate');

    // Iniciar todo
    this.init();
  }

  async init() {
    await this.initSelectTipoMaterial();
    await this.initSelectTipoCategoria();

    document.querySelector('#btn-add-row').addEventListener('click', this.addRow.bind(this));
  }

  async initSelectTipoMaterial() {
    let materiales = [];

    try {
      const res = await ServicioTipoMateriales.obtenerTipoMateriales();

      if (res && res.success && Array.isArray(res.data)) {
        materiales = res.data;
      } else {
        console.warn('ServicioTipoMateriales: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo materiales:', err);
    }

    // Guardamos para las filas
    this.tipoMateriales = materiales;

    // // Crear select dinámico general
    // new SelectDinamico({
    //   select: this.selectTipoMaterialGeneral,
    //   data: materiales,
    //   label: (item) => item.c_des_tip_material,
    //   value: 'i_cod_tip_material',
    //   defaultText: 'Seleccione',
    //   onSelect: (item) => {
    //     // opcional
    //   },
    // });
  }

  async initSelectTipoCategoria() {
    let categorias = [];

    try {
      const res = await ServicioTipoCategorias.obtenerTipoCategorias();

      if (res && res.success && Array.isArray(res.data)) {
        categorias = res.data;
      } else {
        console.warn('ServicioTipoCategorias: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener tipo categorías:', err);
    }

    // Guardamos para llenar las filas
    this.tipoCategorias = categorias;

    // // Crear select dinámico general
    // new SelectDinamico({
    //   select: this.selectTipoCategoriaGeneral,
    //   data: categorias,
    //   label: (item) => item.c_des_tip_categoria,
    //   value: 'i_cod_tip_categoria',
    //   defaultText: 'Seleccione',
    //   onSelect: (item) => {
    //     // opcional
    //   },
    // });
  }

  // ============================================================
  // 3. AGREGAR FILA — cada select es un SelectDinamico real
  // ============================================================
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

    const selectMurosColumnas = newRow.querySelector('select[name="muros_columnas"]');
    const selectTechos = newRow.querySelector('select[name="techos"]');
    const selectPisos = newRow.querySelector('select[name="pisos"]');
    const selectPuertasVentanas = newRow.querySelector('select[name="puertas_ventanas"]');

    // ==========================================
    // Crear SelectDinamico en cada select MATERIAL
    // ==========================================

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

    // ==========================================
    // Crear SelectDinamico en cada select CATEGORÍA
    // ==========================================

    new SelectDinamico({
      select: selectMurosColumnas,
      data: this.tipoCategorias,
      label: (item) => item.c_des_tip_categoria,
      value: 'i_cod_tip_categoria',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectTechos,
      data: this.tipoCategorias,
      label: (item) => item.c_des_tip_categoria,
      value: 'i_cod_tip_categoria',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectPisos,
      data: this.tipoCategorias,
      label: (item) => item.c_des_tip_categoria,
      value: 'i_cod_tip_categoria',
      defaultText: 'Seleccione',
    });

    new SelectDinamico({
      select: selectPuertasVentanas,
      data: this.tipoCategorias,
      label: (item) => item.c_des_tip_categoria,
      value: 'i_cod_tip_categoria',
      defaultText: 'Seleccione',
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.ConstruccionesInstance = new Construcciones();
});
