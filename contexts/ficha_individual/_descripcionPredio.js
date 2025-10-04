window.addEventListener('load', () => {
  cargarClasificacionesPredios();
});

async function cargarClasificacionesPredios() {
  try {
    const res = await fetch('../../database/obtenerClasificacionesPredios.php');
    const data = await res.json();

    const select = document.getElementById('select-clasificaciones-predios');
    Helper.llenarSelect(select, data.data, 'c_cod_tipo_clasificacion', 'c_desc_tipo_clasificacion');
    // select.innerHTML = '';

    // let options = Helper.generarOpciones(
    //   data.data,
    //   'c_cod_tipo_clasificacion',
    //   'c_desc_tipo_clasificacion'
    // );

    // select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando clasificaciones declarantes:', err);
  }
}

let usos = [];

async function cargarUsos(texto = '') {
  try {
    const res = await fetch(`../../database/obtenerUsos.php?q=${encodeURIComponent(texto)}`);
    const data = await res.json();
    usos = data.data;
    return usos;
  } catch (err) {
    console.error('Error cargando usos:', err);
    return [];
  }
}

// Eventos

document.addEventListener('click', async (e) => {
  if (e.target.classList.contains('input-text-uso')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-uso');

    let resultados = await cargarUsos('');

    Helper.mostrarSugerencias(input, resultados, 'desc_uso', hiddenInput, 'codi_uso');
  }
});

document.addEventListener('keyup', async (e) => {
  if (e.target.classList.contains('input-text-uso')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-uso');
    const texto = input.value;

    let resultados = await cargarUsos(texto);
    Helper.mostrarSugerencias(input, resultados, 'desc_uso', hiddenInput, 'codi_uso');
  }
});

document.addEventListener(
  'blur',
  (e) => {
    if (
      e.target.classList.contains('input-text-uso') ||
      e.target.classList.contains('input-hidden-uso')
    ) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);
