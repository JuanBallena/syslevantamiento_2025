class DatosGenerales {
  constructor() {
    this.inputSector = document.querySelector('[name="nomb_sector"]');
    this.hiddenSector = document.querySelector('[name="id_sector"]');
    document.querySelector('input[name="nume_mzna"]');

    this.initAutocompleteSector();
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
      onSelect: (item) => {
        this.initAutocompleteManzana(item.id_sector);
      },
    });
  }

  async initAutocompleteManzana(idSector) {
    let manzanas = [];

    try {
      const res = await ServicioManzanas.obtenerManzanas(idSector);

      if (res && res.success && Array.isArray(res.data)) {
        manzanas = res.data;
        console.log(manzanas);
      } else {
        console.warn('ServicioManzanas: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener manzanas:', err);
    }

    new Autocomplete({
      input: document.querySelector('input[name="nume_mzna"]'),
      inputHidden: document.querySelector('input[name="id_mzna"]'),
      data: manzanas,
      label: (item) => `${item.codi_mzna}`,
      value: 'id_mzna',
      onSelect: (item) => {
        //
      },
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new DatosGenerales();
});
