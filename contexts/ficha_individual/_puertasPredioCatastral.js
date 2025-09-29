window.addEventListener('load', async () => {
  await cargarTipoVias();
  await cargarVias();
  agregarVia();
});

var tipoVias = [];
var vias = [];

async function cargarTipoVias() {
  try {
    const res = await fetch('../../database/obtenerTipoVias.php');
    const data = await res.json();
    tipoVias = data.data;
  } catch (err) {
    console.error('Error cargando tipo vias:', err);
  }
}

async function cargarVias() {
  try {
    const res = await fetch('../../database/obtenerVias.php');
    const data = await res.json();
    vias = data.data;
  } catch (err) {
    console.error('Error cargando vias:', err);
  }
}

let listaVias = [];

function agregarVia() {
  const viaId = Helper.generarId();
  listaVias.push({ id: viaId, puertas: [] });

  const contenedor = document.getElementById('contenedor-vias');

  const nuevaVia = document.createElement('div');
  nuevaVia.classList.add('m-form-section', 'u-relative');
  nuevaVia.dataset.via = viaId;

  nuevaVia.innerHTML = `
    <div class="a-close-button is-danger-color btn-eliminar-via">x</div>
    <div class="m-form-section__title">Vía</div>

    <div class="o-grid o-grid__five-columns">
      <div class="o-grid__first-column">
        <label>Tipo de Vía</label>
        <div class="a-autocomplete">
          <input type="text" 
                 class="a-input-text input-tipo-via" 
                 placeholder="Escriba" />
          <input type="hidden" class="input-hidden-tipo-via" 
                 name="via[${viaId}][tipoViaId]" />
          <div class="a-autocomplete__box none contenedor-tipo-vias">
            <ul class="a-autocomplete__items lista-tipo-vias"></ul>
          </div>
        </div>
      </div>
      <div class="o-grid__second-column">
        <label>Nombre de Vía</label>
        <div class="a-autocomplete">
          <input type="text" 
                 class="a-input-text input-via" 
                 placeholder="Escriba" />
          <input type="hidden" class="input-hidden-via" 
                 name="via[${viaId}][viaId]" />
          <div class="a-autocomplete__box none contenedor-vias">
            <ul class="a-autocomplete__items lista-vias"></ul>
          </div>
        </div>
      </div>
    </div>

    <div class="o-grid o-grid--14rem contenedor-puertas"></div>
    <div>
      <button type="button" class="a-btn a-btn--secondary btn-agregar-puerta">
        Añadir Puerta
      </button>
    </div>
  `;

  contenedor.appendChild(nuevaVia);

  agregarPuerta(viaId);
}

function agregarPuerta(viaId) {
  const via = listaVias.find((v) => v.id === viaId);
  if (!via) return;

  const puertaId = Helper.generarId();
  via.puertas.push({ id: puertaId });

  const viaEl = document.querySelector(`[data-via="${viaId}"]`);
  const contenedorPuertas = viaEl.querySelector('.contenedor-puertas');

  const nuevaPuerta = document.createElement('div');
  nuevaPuerta.classList.add('o-container', 'u-relative');
  nuevaPuerta.dataset.puerta = puertaId;

  let opcionesPuertas = `<option value="0" selected>Seleccione</option>`;
  DataSelect.tipoPuertaOpciones.forEach((p) => {
    opcionesPuertas += `<option value="${p.id}">${p.nombre}</option>`;
  });

  nuevaPuerta.innerHTML = `
    <div class="a-close-button is-danger-color btn-eliminar-puerta">x</div>
    <div class="a-text--center">Puerta</div>
    <label>Tipo</label>
    <select class="a-input-text puerta-tipo" 
            name="via[${viaId}][puerta][${puertaId}][tipo]">
      ${opcionesPuertas}
    </select>
    <label>Nro. Municipal</label>
    <input placeholder="Escriba" class="a-input-text puerta-numero" type="text" 
           name="via[${viaId}][puerta][${puertaId}][numero]" />
  `;

  contenedorPuertas.appendChild(nuevaPuerta);
}

function eliminarVia(viaId) {
  listaVias = listaVias.filter((v) => v.id !== viaId);
  document.querySelector(`[data-via="${viaId}"]`)?.remove();
}

function eliminarPuerta(viaId, puertaId) {
  const via = listaVias.find((v) => v.id === viaId);
  if (!via) return;
  via.puertas = via.puertas.filter((p) => p.id !== puertaId);
  document.querySelector(`[data-via="${viaId}"] [data-puerta="${puertaId}"]`)?.remove();
}

document.getElementById('btn-agregar-via').addEventListener('click', () => {
  agregarVia();
});

document.addEventListener('click', (e) => {
  if (e.target.classList.contains('input-tipo-via')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-tipo-via');

    Helper.mostrarSugerencias(input, tipoVias, 'c_desc_tipo_via', hiddenInput, 'c_cod_tipo_via');
  }

  if (e.target.classList.contains('input-via')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-via');

    Helper.mostrarSugerencias(input, vias, 'nomb_via', hiddenInput, 'id_via');
  }

  if (e.target.classList.contains('btn-eliminar-via')) {
    const viaId = e.target.closest('[data-via]').dataset.via;
    eliminarVia(viaId);
  }

  if (e.target.classList.contains('btn-eliminar-puerta')) {
    const viaEl = e.target.closest('[data-via]');
    const puertaEl = e.target.closest('[data-puerta]');
    if (viaEl && puertaEl) {
      eliminarPuerta(viaEl.dataset.via, puertaEl.dataset.puerta);
    }
  }

  if (e.target.classList.contains('btn-agregar-puerta')) {
    const viaEl = e.target.closest('[data-via]');
    if (viaEl) {
      agregarPuerta(viaEl.dataset.via);
    }
  }
});

document.addEventListener('keyup', (e) => {
  if (e.target.classList.contains('input-tipo-via')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-tipo-via');
    const texto = input.value;
    const resultados = Helper.filtrarLista(texto, tipoVias, 'c_desc_tipo_via');
    Helper.mostrarSugerencias(input, resultados, 'c_desc_tipo_via', hiddenInput, 'c_cod_tipo_via');
  }

  if (e.target.classList.contains('input-via')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-via');
    const texto = input.value;
    const resultados = Helper.filtrarLista(texto, vias, 'nomb_via');
    Helper.mostrarSugerencias(input, resultados, 'nomb_via', hiddenInput, 'id_via');
  }
});

document.addEventListener(
  'blur',
  (e) => {
    if (e.target.classList.contains('input-tipo-via') || e.target.classList.contains('input-via')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);
