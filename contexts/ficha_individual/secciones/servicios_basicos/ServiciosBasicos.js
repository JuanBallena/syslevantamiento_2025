class ServiciosBasicos {
  constructor() {
    //
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return this.booleanToInt(formDataExtractor.obtenerDatosDesdeContenedor('servicios-basicos'));
  }

  booleanToInt(obj) {
    const nuevo = {};

    for (const key in obj) {
      const val = obj[key];

      // Si es booleano → convertir a 1 o 0
      if (typeof val === 'boolean') {
        nuevo[key] = val ? 1 : 0;
      } else {
        nuevo[key] = val; // conservar valores no booleanos
      }
    }

    return nuevo;
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  window.serviciosBasicos = new ServiciosBasicos();
});
