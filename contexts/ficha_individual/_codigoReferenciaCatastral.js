window.addEventListener('load', () => {
  cargarSectores();
  cargarManzanas();
});

// autompletado sector y manzanas
var sectores = [];
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

async function cargarManzanas() {
  try {
    const res = await fetch('../../database/obtenerManzanas.php');
    const data = await res.json();

    manzanas = data.data;
  } catch (err) {
    console.error('Error cargando manzanas:', err);
  }
}

document.addEventListener('click', (e) => {
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

    Helper.mostrarSugerencias(input, manzanas, 'nume_mzna', hiddenInput, 'id_mzna', null, '');
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
  }

  if (e.target.classList.contains('input-text-codigo-manzana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-codigo-manzana');
    const texto = input.value;
    const resultados = Helper.filtrarLista(texto, manzanas, 'codi_mzna');
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
