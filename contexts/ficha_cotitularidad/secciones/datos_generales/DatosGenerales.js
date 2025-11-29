class DatosGenerales {
  constructor() {
    this.sectores = [];
    this.manzanas = [];
    this.autocompleteManzana = null;

    const contenedor = document.getElementById('datos-generales');
    this.inputNombSector = contenedor.querySelector('[name="nomb_sector"]');
    this.inputIdSector = contenedor.querySelector('[name="id_sector"]');
    this.inputNumeMzna = contenedor.querySelector('input[name="nume_mzna"]');
    this.inputIdMzna = contenedor.querySelector('input[name="id_mzna"]');
  }

  async init() {
    await this.cargarSectores();
    this.initAutocompleteSector();
    this.initAutocompleteManzana();
  }

  async cargarSectores() {
    try {
      const res = await ServicioSectores.obtenerSectores();

      if (res && res.success && Array.isArray(res.data)) {
        this.sectores = res.data;
      } else {
        console.warn('ServicioSectores: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener sectores:', err);
    }
  }

  async cargarManzanasSegunIdSector(idSector) {
    try {
      const res = await ServicioManzanas.obtenerManzanas(idSector);

      if (res && res.success && Array.isArray(res.data)) {
        this.manzanas = res.data;
      } else {
        console.warn('ServicioManzanas: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener manzanas:', err);
    }
  }

  async initAutocompleteSector() {
    new Autocomplete({
      input: this.inputNombSector,
      inputHidden: this.inputIdSector,
      data: this.sectores,
      label: (item) => `${item.codi_sector}, ${item.nomb_sector}`,
      value: 'id_sector',
      onSelect: async (item) => {
        this.autocompleteManzana.updateData([]);
        await this.cargarManzanasSegunIdSector(item.id_sector);
        this.autocompleteManzana.updateData(this.manzanas);
      },
      onInput: () => {
        this.inputNumeMzna.value = '';
        this.inputIdMzna.value = '';
      },
    });
  }

  async initAutocompleteManzana() {
    this.autocompleteManzana = new Autocomplete({
      input: this.inputNumeMzna,
      inputHidden: this.inputIdMzna,
      data: [],
      label: (item) => `${item.codi_mzna}`,
      value: 'id_mzna',
      onSelect: (item) => {
        //
      },
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('datos-generales');
  }
}

document.addEventListener('DOMContentLoaded', async () => {
  const datosGenerales = new DatosGenerales();

  await datosGenerales.init();

  const buscarFicha = new BuscarFicha({
    datosGeneralesData: datosGenerales,
  });

  window.datosGenerales = datosGenerales;
  window.buscarFicha = buscarFicha;
});
