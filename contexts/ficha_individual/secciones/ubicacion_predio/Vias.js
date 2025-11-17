class Vias {
  constructor() {
    this.vias = [];
    this.listaVias = [];

    this.contenedorVias = document.getElementById('contenedor-vias');
    this.btnAgregarVia = document.getElementById('btn-agregar-via');

    this.init();
  }

  async init() {
    await this.cargarVias();

    this.agregarVia();
    this.btnAgregarVia.addEventListener('click', () => this.agregarVia());
    this.initEventosGlobales();
  }

  async cargarVias() {
    try {
      const res = await ServicioVias.obtenerVias();
      if (res && res.success && Array.isArray(res.data)) {
        this.vias = res.data;
      } else {
        console.warn('ServicioVias: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener vias:', err);
    }
  }

  async agregarVia() {
    const viaId = Helper.generarId();
    this.listaVias.push({ id: viaId, puertas: [] });

    const contenedorVias = document.getElementById('contenedor-vias');
    const formularioVia = await this.crearFormularioVia(viaId);
    contenedorVias.insertAdjacentHTML('beforeend', formularioVia);

    const nuevosInputs = document.querySelectorAll(`[data-via="${viaId}"] [autocomplete]`);

    nuevosInputs.forEach((input) => {
      new Autocomplete({
        input,
        data: this.vias,
        label: (item) => `${item.codi_via}`,
        value: 'id_via',
        onSelect: (item) => {
          const section = input.closest('[data-via]');

          const hiddenSelector = input.dataset.target;
          if (hiddenSelector) {
            const hidden = section.querySelector(hiddenSelector);
            hidden.value = item[input.dataset.value];
          }

          section.querySelector('input[name="tipo_via"]').value = item.tipo_via;
          section.querySelector('input[name="nomb_via"]').value = item.nomb_via;
        },
        onInput: () => {
          const section = input.closest('[data-via]');

          section.querySelector('input[name="tipo_via"]').value = '';
          section.querySelector('input[name="nomb_via"]').value = '';
        },
      });
    });

    this.agregarPuerta(viaId);
  }

  async crearFormularioVia(viaId) {
    const placeholders = { '{{viaId}}': viaId };
    const res = await fetch('./../ficha_individual/secciones/ubicacion_predio/Vias.html');
    let html = await res.text();

    for (const [key, value] of Object.entries(placeholders)) {
      html = html.replaceAll(key, value);
    }
    return html;
  }

  async agregarPuerta(viaId) {
    const via = this.listaVias.find((v) => v.id === viaId);
    if (!via) return;

    const puertaId = Helper.generarId();
    via.puertas.push({ id: puertaId });

    const viaEl = this.contenedorVias.querySelector(`[data-via="${viaId}"]`);
    if (!viaEl) return console.error('❌ No se encontró el contenedor de la vía');

    const contenedorPuertas = viaEl.querySelector('.contenedor-puertas');
    if (!contenedorPuertas)
      return console.error('❌ No existe .contenedor-puertas dentro del FormularioVia.html');

    const index = contenedorPuertas.querySelectorAll('[data-tipo="puerta"]').length;
    const formularioPuerta = await this.crearFormularioPuerta(index, viaId, puertaId);

    contenedorPuertas.insertAdjacentHTML('beforeend', formularioPuerta);

    const selectTipoPuertas = document.querySelectorAll(
      `[data-via="${viaId}"] [data-puerta="${puertaId}"] [select-tipo-puerta]`
    );

    selectTipoPuertas.forEach((select) => {
      new SelectDinamico({
        select,
        data: Puertas.tipos,
        label: (item) => `${item.text}`,
        value: 'value',
        onSelect: (item) => {
          //
        },
      });
    });

    const selectCondNume = document.querySelectorAll(
      `[data-via="${viaId}"] [data-puerta="${puertaId}"] [select-cond-nume]`
    );

    selectCondNume.forEach((select) => {
      new SelectDinamico({
        select,
        data: Puertas.condiciones,
        label: (item) => `${item.text}`,
        value: 'value',
        onSelect: (item) => {
          //
        },
      });
    });
  }

  async crearFormularioPuerta(index, viaId, puertaId) {
    const placeholders = {
      '{{index}}': index + 1,
      '{{viaId}}': viaId,
      '{{puertaId}}': puertaId,
    };

    const res = await fetch('./../ficha_individual/secciones/ubicacion_predio/Puertas.html');
    let html = await res.text();

    for (const [key, value] of Object.entries(placeholders)) {
      html = html.replaceAll(key, value);
    }

    return html;
  }

  eliminarVia(viaId) {
    this.listaVias = this.listaVias.filter((v) => v.id !== viaId);
    this.contenedorVias.querySelector(`[data-via="${viaId}"]`)?.remove();
  }

  eliminarPuerta(viaId, puertaId) {
    const via = this.listaVias.find((v) => v.id === viaId);
    if (!via) return;
    via.puertas = via.puertas.filter((p) => p.id !== puertaId);
    this.contenedorVias
      .querySelector(`[data-via="${viaId}"] [data-puerta="${puertaId}"]`)
      ?.remove();
  }

  initEventosGlobales() {
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('btn-eliminar-via')) {
        const viaId = e.target.closest('[data-via]').dataset.via;
        this.eliminarVia(viaId);
      }

      if (e.target.classList.contains('btn-eliminar-puerta')) {
        const viaEl = e.target.closest('[data-via]');
        const puertaEl = e.target.closest('[data-puerta]');
        if (viaEl && puertaEl) {
          this.eliminarPuerta(viaEl.dataset.via, puertaEl.dataset.puerta);
        }
      }

      if (e.target.classList.contains('btn-agregar-puerta')) {
        const viaEl = e.target.closest('[data-via]');
        if (viaEl) this.agregarPuerta(viaEl.dataset.via);
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new Vias();
});
