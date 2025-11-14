window.addEventListener('load', async () => {
  await cargarVias();

  agregarVia();
});

var vias = [];
let listaVias = [];

async function cargarVias() {
  try {
    const res = await fetch('../../database/obtenerVias.php');
    const data = await res.json();
    vias = data.data;
  } catch (err) {
    console.error('Error cargando vias:', err);
  }
}

async function agregarVia() {
  const viaId = Helper.generarId();
  listaVias.push({ id: viaId, puertas: [] });

  const contenedorVias = document.getElementById('contenedor-vias');
  const formularioVia = await crearFormularioVia(viaId);
  contenedorVias.insertAdjacentHTML('beforeend', formularioVia);

  // Aquí inicializas el autocomplete del formulario insertado
  const nuevosInputs = document.querySelectorAll(`[data-via="${viaId}"] [data-autocomplete]`);

  nuevosInputs.forEach((input) => {
    new Autocomplete({
      input,
      data: vias,
      label: input.dataset.label,
      value: input.dataset.value,
      onSelect: (item) => {
        const section = input.closest('[data-via]');

        // Llenar hidden
        const hiddenSelector = input.dataset.target;
        if (hiddenSelector) {
          const hidden = section.querySelector(hiddenSelector);
          hidden.value = item[input.dataset.value];
        }

        // Llenar tipo de vía
        section.querySelector('.tipo-via').value = item.tipo_via;

        // Llenar nombre de vía
        section.querySelector('.nomb-via').value = item.nomb_via;
      },
    });
  });

  agregarPuerta(viaId);
}

async function crearFormularioVia(viaId) {
  const placeholders = {
    '{{viaId}}': viaId,
  };

  const res = await fetch('FormularioVia.html');
  let html = await res.text();

  for (const [key, value] of Object.entries(placeholders)) {
    html = html.replaceAll(key, value);
  }

  return html;
}

async function agregarPuerta(viaId) {
  const via = listaVias.find((v) => v.id === viaId);
  if (!via) return;

  const puertaId = Helper.generarId();
  via.puertas.push({ id: puertaId });

  console.log('viaId:', viaId);

  const viaEl = document.querySelector(`[data-via="${viaId}"]`);
  console.log('viaEl:', viaEl);

  if (!viaEl) {
    console.error('❌ No se encontró el contenedor de la vía');
  }

  const contenedorPuertas = viaEl?.querySelector('.contenedor-puertas');
  console.log('contenedorPuertas:', contenedorPuertas);

  if (!contenedorPuertas) {
    console.error('❌ No existe .contenedor-puertas dentro del FormularioVia.html');
  }
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
    html = html.replaceAll(key, value);
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

//Eventos

document.addEventListener('click', (e) => {
  // if (e.target.classList.contains('input-tipo-via')) {
  //   const input = e.target;
  //   const hiddenInput = input.parentElement.querySelector('.input-hidden-tipo-via');

  //   Helper.mostrarSugerencias(input, tipoVias, 'c_desc_tipo_via', hiddenInput, 'c_cod_tipo_via');
  // }

  // if (e.target.classList.contains('input-via')) {
  //   const input = e.target;
  //   const hiddenInput = input.parentElement.querySelector('.input-hidden-via');

  //   const section = input.closest('.m-form-section');
  //   const inputReadonly = section.querySelector('.codigo-via-readonly');

  //   Helper.mostrarSugerencias(
  //     input,
  //     vias,
  //     'nomb_via',
  //     hiddenInput,
  //     'id_via',
  //     inputReadonly,
  //     'codi_via'
  //   );
  // }

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

// function buscarVia(input) {
//   const contenedor = input.parentElement.querySelector('section');
//   const ul = contenedor.querySelector('ul');
//   ul.innerHTML = '';

//   if (vias.length === 0) {
//     ul.appendChild(Autocompletado.crearLiSinOpciones());
//     return;
//   }

//   vias.forEach((item) => {
//     ul.appendChild(Autocompletado.crearLi(item['codi_via'], item));
//   });

//   contenedor.classList.remove('none');

//   ul.onclick = (e) => {
//     if (e.target.tagName === 'LI' && e.target.dataset.disabled !== 'true') {
//       const item = JSON.parse(e.target.dataset.item);

//       input.value = item['codi_via'];
//       document.querySelector('.id-via').value = item['id_via'];
//       document.querySelector('.nomb-via').value = item['nomb_via'];
//       document.querySelector('.tipo-via').value = item['tipo_via'];

//       contenedor.classList.add('none');
//     }
//   };
// }

// document.addEventListener('keyup', (e) => {
//   if (e.target.matches('.codi-via')) {
//     buscarVia(e.target);
//   }
// });

// document.addEventListener('click', (e) => {
//   if (e.target.matches('.codi-via')) {
//     buscarVia(e.target);
//   }
// });

// document.addEventListener(
//   'blur',
//   (e) => {
//     if (e.target.matches('.codi-via')) {
//       Autocompletado.cerrar(e.target);
//     }
//   },
//   true
// );
