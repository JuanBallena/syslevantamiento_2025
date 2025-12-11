class DatosGenerales {
  constructor() {
    this.autocompleteManzana = null;

    this.inputSector = document.querySelector('[name="nomb_sector"]');
    this.hiddenSector = document.querySelector('[name="id_sector"]');
    this.inputNumeMzna = document.querySelector('input[name="nume_mzna"]');
    this.hiddenNumeMzna = document.querySelector('input[name="id_mzna"]');
    this.inputLote = document.querySelector('input[name="codi_lote"]');
    this.inputEdifica = document.querySelector('input[name="codi_edificacion"]');

    this.initAutocompleteSector();
    this.initAutocompleteManzana();
    this.eventosLocales();
  }

  async initAutocompleteSector() {
    let sectores = [];

    try {
      const res = await ServicioSectores.obtenerSectores();

      if (res && res.success && Array.isArray(res.data)) {
        sectores = res.data;
      } else {
        console.warn('ServicioSectores: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener sectores:', err);
    }

    new Autocomplete({
      input: this.inputSector,
      inputHidden: this.hiddenSector,
      data: sectores,
      label: (item) => `${item.codi_sector}, ${item.nomb_sector}`,
      value: 'id_sector',
      onSelect: async (item) => {
        await this.actualizarAutocompleteManzanas(item.id_sector);

        // this.validarCombinacion();
      },
      onInput: () => {
        this.inputNumeMzna.value = '';
        this.hiddenNumeMzna.value = '';

        // this.validarCombinacion();
      },
    });
  }

  async initAutocompleteManzana() {
    this.autocompleteManzana = new Autocomplete({
      input: this.inputNumeMzna,
      inputHidden: this.hiddenNumeMzna,
      data: [],
      label: (item) => `${item.codi_mzna}`,
      value: 'id_mzna',
      onSelect: (item) => {
        // this.validarCombinacion();
      },
      onInput: () => {
        // this.validarCombinacion();
      },
    });
  }

  async actualizarAutocompleteManzanas(idSector) {
    this.autocompleteManzana.updateData([]);

    try {
      const res = await ServicioManzanas.obtenerManzanas(idSector);

      if (res && res.success && Array.isArray(res.data)) {
        this.autocompleteManzana.updateData(res.data);
      } else {
        console.warn('ServicioManzanas: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener manzanas:', err);
    }
  }

  eventosLocales() {
    this.inputLote.addEventListener('input', async () => {
      await this.validarLote();
    });

    this.inputEdifica.addEventListener('input', async () => {
      await this.validarEdifica();
    });
  }

  async validarLote() {
    const idMzna = this.hiddenNumeMzna.value.trim();
    const lote = this.inputLote.value.trim();

    if (idMzna && lote) {
      try {
        const res = await ServicioLotes.obtenerLotePorId(`${idMzna}${lote}`);

        if (res && res.success) {
          alert('Se encontró un lote existente, cambiar lote.');
        }
      } catch (err) {
        console.error('Error al obtener lote:', err);
      }
    }
  }

  async validarEdifica() {
    const idMzna = this.hiddenNumeMzna.value.trim();
    const lote = this.inputLote.value.trim();
    const edifica = this.inputEdifica.value.trim();

    if (idMzna && lote && edifica) {
      try {
        const res = await ServicioEdificaciones.obtenerEdificacionPorId(
          `${idMzna}${lote}${edifica}`
        );

        if (res && res.success) {
          alert('Se encontró una edificación existente, cambiar edifica.');
        }
      } catch (err) {
        console.error('Error al obtener edificacion:', err);
      }
    }
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('datos-generales');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.datosGenerales = new DatosGenerales();
});
