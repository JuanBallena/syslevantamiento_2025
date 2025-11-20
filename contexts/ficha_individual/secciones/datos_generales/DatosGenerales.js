class DatosGenerales {
  constructor() {
    this.autocompleteManzana = null;

    this.inputSector = document.querySelector('[name="nomb_sector"]');
    this.hiddenSector = document.querySelector('[name="id_sector"]');
    this.inputNumeMzna = document.querySelector('input[name="nume_mzna"]');
    this.hiddenNumeMzna = document.querySelector('input[name="id_mzna"]');

    this.initAutocompleteSector();
    this.initAutocompleteManzana();
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

        this.inputNumeMzna.disabled = false;
      },
      onInput: () => {
        this.inputNumeMzna.value = '';
        this.hiddenNumeMzna.value = '';
        this.inputNumeMzna.disabled = true;
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
        //
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

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('datos-generales');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.datosGenerales = new DatosGenerales();
});
