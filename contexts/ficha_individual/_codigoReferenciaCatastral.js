window.addEventListener('load', () => {
  cargarSectores();
  // cargarManzanas();
});

// autompletado sector y manzanas
var sectores = [];
var idSector = null;
var manzanas = [];

async function cargarSectores() {
  try {
    const res = await fetch('../../database/obtenerSectores.php');
    const data = await res.json();

    sectores = data.data;
  } catch (err) {
    console.error('Error cargando sectores:', err);
  }
}

async function cargarManzanas(idSector = null) {
  try {
    const url = idSector
      ? `../../database/obtenerManzanas.php?id_sector=${idSector}`
      : '../../database/obtenerManzanas.php';

    const res = await fetch(url);
    const data = await res.json();

    return data.data;
  } catch (err) {
    console.error('Error cargando manzanas:', err);
  }
}

document.addEventListener('click', async (e) => {
  if (e.target.classList.contains('input-text-codigo-sector')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-codigo-sector');

    Helper.mostrarSugerencias(
      input,
      sectores,
      'codi_sector',
      hiddenInput,
      'id_sector',
      null,
      '',
      'nomb_sector'
    );
  }

  if (e.target.classList.contains('input-text-codigo-manzana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-codigo-manzana');

    const codigoReferenciaCatastral = document.getElementById('codigo-referencia-catastral');
    let idSector = codigoReferenciaCatastral.querySelector('[name="id_sector"]').value || null;

    if (idSector) {
      manzanas = await cargarManzanas(idSector);

      Helper.mostrarSugerencias(input, manzanas, 'nume_mzna', hiddenInput, 'id_mzna', null, '');
    }
  }
});

document.addEventListener('keyup', (e) => {
  if (e.target.classList.contains('input-text-codigo-sector')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-codigo-sector');
    const texto = input.value;
    const resultados = Helper.filtrarLista(texto, sectores, 'codi_sector');
    Helper.mostrarSugerencias(
      input,
      resultados,
      'codi_sector',
      hiddenInput,
      'id_sector',
      null,
      '',
      'nomb_sector'
    );

    // document.querySelector('.input-text-codigo-manzana').value = '';
    // document.querySelector('.input-hidden-codigo-manzana').value = '';
  }

  if (e.target.classList.contains('input-text-codigo-manzana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-codigo-manzana');
    const texto = input.value;
    const resultados = Helper.filtrarLista(texto, manzanas, 'nume_mzna');
    Helper.mostrarSugerencias(input, resultados, 'nume_mzna', hiddenInput, 'id_mzna', null, '');
  }
});

document.addEventListener(
  'blur',
  (e) => {
    if (e.target.classList.contains('input-text-codigo-sector')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }

    if (e.target.classList.contains('input-text-codigo-manzana')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);

// function onChangeSector() {
//   alert('Cambio de sector');
//   document.querySelector('.input-text-codigo-manzana').value = '';
//   document.querySelector('.input-hidden-codigo-manzana').value = '';
// }
