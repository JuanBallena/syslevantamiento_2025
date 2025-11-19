class FormDataExtractor {
  constructor() {}

  evaluarValorInput(input) {
    let value = input.value?.trim() ?? '';

    // Si el valor está vacío, devolver un valor según el tipo
    if (!value) {
      switch (input.type) {
        case 'number':
          return 0;
        case 'checkbox':
          return input.checked;
        default: // text, select, etc.
          return '';
      }
    }

    // number → convertir
    if (input.type === 'number' && !isNaN(value)) {
      return Number(value);
    }

    // checkbox → true/false
    if (input.type === 'checkbox') {
      return input.checked;
    }

    return value;
  }

  asignarValor(result, name, value) {
    if (name.endsWith('[]')) {
      const cleanName = name.replace('[]', '');
      if (!result[cleanName]) {
        result[cleanName] = [];
      }
      result[cleanName].push(value);
    } else {
      result[name] = value;
    }
  }

  getContenedor(ref) {
    if (!ref) return null;

    // Si pasan un elemento DOM
    if (ref instanceof HTMLElement) return ref;

    // Si pasan un selector CSS (empieza con . # [data-)
    if (typeof ref === 'string' && /[.#\[]/.test(ref)) {
      return document.querySelector(ref);
    }

    // Si pasan un ID simple
    if (typeof ref === 'string') {
      return document.getElementById(ref) || document.querySelector(`[data-${ref}]`);
    }

    return null;
  }

  obtenerDatosDesdeContenedor(
    refContenedor,
    selectorCampos = 'input[name], select[name], textarea[name]'
  ) {
    const contenedor = this.getContenedor(refContenedor);

    if (!contenedor) {
      console.warn(`No se encontró el contenedor usando referencia: "${refContenedor}"`);
      return {};
    }

    const campos = contenedor.querySelectorAll(selectorCampos);
    const result = {};

    campos.forEach((campo) => {
      const name = campo.name;
      const value = this.evaluarValorInput(campo);
      this.asignarValor(result, name, value);
    });

    return result;
  }

  obtenerDatosDesdeDataset(refContenedor, selectorItem, selectorSubItem = null) {
    const contenedor = this.getContenedor(refContenedor);
    if (!contenedor) return [];

    const items = [];

    contenedor.querySelectorAll(selectorItem).forEach((itemEl) => {
      // Nivel 1: item
      const itemData = this.obtenerDatosDesdeContenedor(itemEl);

      // Nivel 2: subitems (solo si se define selectorSubItem)
      if (selectorSubItem) {
        const subItems = [];
        itemEl.querySelectorAll(selectorSubItem).forEach((subEl, index) => {
          const subData = this.obtenerDatosDesdeContenedor(subEl);
          subData.codigo = String(index + 1);
          subItems.push(subData);
        });

        // nombre dinámico del subarray basado en dataset: data-puerta → puertas
        const nameDS = selectorSubItem.replace('[data-', '').replace(']', '');
        const campo = nameDS.endsWith('s') ? nameDS : nameDS + 's';

        itemData[campo] = subItems;
      }

      items.push(itemData);
    });

    return items;
  }

  obtenerDatosDesdeTabla(
    refTabla,
    selectorFilas = 'tbody tr',
    selectorCampos = 'input[name], select[name], textarea[name]'
  ) {
    const tabla = this.getContenedor(refTabla);

    if (!tabla) {
      console.warn(`No se encontró tabla usando referencia: "${refTabla}"`);
      return [];
    }

    const filas = tabla.querySelectorAll(selectorFilas);
    const resultados = [];

    filas.forEach((fila, index) => {
      const datosFila = {};
      const campos = fila.querySelectorAll(selectorCampos);

      campos.forEach((campo) => {
        const nombre = campo.name;
        const valor = this.evaluarValorInput(campo);
        this.asignarValor(datosFila, nombre, valor);
      });

      // Código incremental automático
      datosFila.codigo = index + 1;

      resultados.push(datosFila);
    });

    return resultados;
  }
}
