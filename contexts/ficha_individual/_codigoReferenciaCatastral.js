window.addEventListener('load', () => {
  cargarSectores();
});

// autompletado sector
var sectores = [];

async function cargarSectores() {
  try {
    const res = await fetch('../../database/obtenerSectores.php');
    const data = await res.json();

    sectores = data.data;
  } catch (err) {
    console.error('Error cargando sectores:', err);
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
});

document.addEventListener(
  'blur',
  (e) => {
    if (e.target.classList.contains('input-text-codigo-sector')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);
