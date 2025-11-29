class BuscarFicha {
  constructor({ datosGeneralesData }) {
    this.autocompleteManzana = null;

    this.contenedorBuscarFicha = document.getElementById('buscar-ficha');
    this.contenedorFormularioFichaCotitularidad = document.getElementById(
      'contenedor-formulario-ficha-cotitularidad'
    );
    console.log(this.contenedorFormularioFichaCotitularidad);
    this.inputNombSector = this.contenedorBuscarFicha.querySelector('[name="nomb_sector"]');
    this.inputIdSector = this.contenedorBuscarFicha.querySelector('[name="id_sector"]');
    this.inputNumeMzna = this.contenedorBuscarFicha.querySelector('input[name="nume_mzna"]');
    this.inputIdMzna = this.contenedorBuscarFicha.querySelector('input[name="id_mzna"]');
    this.inputNumeFicha = this.contenedorBuscarFicha.querySelector('input[name="nume_ficha"]');

    this.errorBuscarFicha = this.contenedorBuscarFicha.querySelector('.error-buscar-ficha');
    this.btnContinuar = this.contenedorBuscarFicha.querySelector('.btn-continuar');

    this.sectores = datosGeneralesData.sectores;
    this.init();
  }

  async init() {
    this.initAutocompleteSector();
    this.initAutocompleteManzana();
    this.eventosLocales();

    this.btnContinuar.addEventListener('click', () => this.continuar());
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

  eventosLocales() {
    const contenedor = document.querySelector('#buscar-ficha');
    const inputs = contenedor.querySelectorAll('input');

    inputs.forEach((input) => {
      input.addEventListener('input', async () => {
        const puedeBuscar = this.todosCompletos() || this.completoLongitud(input);

        if (puedeBuscar) {
          const year = new Date().getFullYear();
          const numeFicha = this.inputNumeFicha.value;
          const UBIGEO = '130101';
          const FICHA_TIPO_INDIVIDUAL = '01';

          try {
            let idFicha = `${year}${UBIGEO}${FICHA_TIPO_INDIVIDUAL}${numeFicha}`;
            const res = await ServicioFicha.obtenerFichaPorNumeroYPorId(numeFicha, idFicha);

            if (res && res.success && Array.isArray(res.data)) {
              this.errorBuscarFicha.textContent = 'Se encontró ficha';
              this.errorBuscarFicha.classList.remove('none');
              this.errorBuscarFicha.classList.remove('alert-danger');
              this.errorBuscarFicha.classList.add('alert-success');
              this.btnContinuar.disabled = false;
            } else {
              this.errorBuscarFicha.textContent = 'No se encontró ficha';
              this.errorBuscarFicha.classList.remove('none');
              this.errorBuscarFicha.classList.remove('alert-success');
              this.errorBuscarFicha.classList.add('alert-danger');
              this.btnContinuar.disabled = true;
            }
          } catch (err) {
            console.error('Error al obtener ficha:', err);
            this.errorBuscarFicha.textContent = 'Ocurrió un error general';
          }
        }
      });
    });
  }

  continuar() {
    this.contenedorFormularioFichaCotitularidad.classList.remove('none');
    this.contenedorBuscarFicha.classList.add('none');
  }

  todosCompletos() {
    const contenedor = document.querySelector('#buscar-ficha');
    const requeridos = contenedor.querySelectorAll('[data-validate*="required"]');

    for (const campo of requeridos) {
      if (campo.value.trim() === '') {
        return false;
      }
    }
    return true;
  }

  obtenerMax(input) {
    const reglas = input.getAttribute('data-validate') || '';
    const match = reglas.match(/max:(\d+)/);
    return match ? parseInt(match[1], 10) : null;
  }

  completoLongitud(input) {
    const max = this.obtenerMax(input);
    if (!max) return false; // si no tiene max, no aplica

    return input.value.trim().length === max;
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('datos-generales');
  }
}
