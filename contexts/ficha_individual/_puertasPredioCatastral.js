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

async function agregarVia() {
  const viaId = Helper.generarId();
  listaVias.push({ id: viaId, puertas: [] });

  const contenedorVias = document.getElementById('contenedor-vias');
  const formularioVia = await crearFormularioVia(viaId);

  contenedorVias.insertAdjacentHTML('beforeend', formularioVia);

  agregarPuerta(viaId);
}

async function crearFormularioVia(viaId) {
  const placeholders = {
    '{{viaId}}': viaId,
  };

  const res = await fetch('FormularioVia.html');
  let html = await res.text();

  for (const [key, value] of Object.entries(placeholders)) {
    html = html.replace(key, value);
  }

  return html;
}

async function agregarPuerta(viaId) {
  const via = listaVias.find((v) => v.id === viaId);
  if (!via) return;

  const puertaId = Helper.generarId();
  via.puertas.push({ id: puertaId });

  const viaEl = document.querySelector(`[data-via="${viaId}"]`);
  const contenedorPuertas = viaEl.querySelector('.contenedor-puertas');
  const index = contenedorPuertas.querySelectorAll('[data-tipo="puerta"]').length;

  const formularioPuerta = await crearFormularioPuerta(index, viaId, puertaId);

  contenedorPuertas.insertAdjacentHTML('beforeend', formularioPuerta);
}

async function crearFormularioPuerta(index, viaId, puertaId) {
  const placeholders = {
    '{{index}}': index + 1,
    '{{viaId}}': viaId,
    '{{puertaId}}': puertaId,
    '{{puertaOpciones}}': Helper.generarOpciones(DataSelect.tipoPuertaOpciones),
  };

  const res = await fetch('FormularioPuerta.html');
  let html = await res.text();

  for (const [key, value] of Object.entries(placeholders)) {
    html = html.replace(key, value);
  }

  return html;
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

    const section = input.closest('.m-form-section');
    const inputReadonly = section.querySelector('.codigo-via-readonly');

    Helper.mostrarSugerencias(
      input,
      vias,
      'nomb_via',
      hiddenInput,
      'id_via',
      inputReadonly,
      'codi_via'
    );
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
