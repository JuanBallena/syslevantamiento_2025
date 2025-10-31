async function cargarPersonas(texto = '', url) {
  try {
    const res = await fetch(`../../database/${url}.php?q=${encodeURIComponent(texto)}`);
    const data = await res.json();

    return data.data;
  } catch (err) {
    console.error('Error cargando personas:', err);
    return [];
  }
}

// Eventos

document.addEventListener('click', async (e) => {
  if (e.target.classList.contains('autocompletado-dni')) {
    //
  }
});

document.addEventListener('keyup', async (e) => {
  if (e.target.classList.contains('autocompletado-dni')) {
    const input = e.target;
    const texto = input.value;
    let url = input.dataset.url;
    let tipo = input.dataset.tipo;
    const section = document.getElementById(`${tipo}`);

    if (texto.length < 8) {
      section.querySelector('[name="nombres"]').value = '';
      section.querySelector('[name="apellido_materno"]').value = '';
      section.querySelector('[name="apellido_paterno"]').value = '';
    }

    let resultados = await cargarPersonas(texto, url);
    Helper.mostrarSugerencias(input, resultados, 'nume_doc', input, 'nume_doc');

    const contenedor = input.parentElement.querySelector('.a-autocomplete__box');
    const ul = contenedor.querySelector('ul');

    ul.onclick = (e) => {
      input.value = e.target.dataset.text.trim();
      const persona = JSON.parse(e.target.dataset.item);
      section.querySelector('[name="nombres"]').value = persona['nombres'];
      section.querySelector('[name="apellido_materno"]').value = persona['ape_materno'];
      section.querySelector('[name="apellido_paterno"]').value = persona['ape_paterno'];

      contenedor.classList.add('none');
    };
  }
});

document.addEventListener(
  'blur',
  (e) => {
    if (e.target.classList.contains('autocompletado-dni')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }

    if (e.target.classList.contains('autocompletado-dni-declarante')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);

async function onKeyupDniDeclarante(input) {
  const texto = input.value;
  const section = document.getElementById('datos-declarante');

  if (texto.length < 8) {
    section.querySelector('[name="nombres"]').value = '';
    section.querySelector('[name="apellido_materno"]').value = '';
    section.querySelector('[name="apellido_paterno"]').value = '';
  }

  let declarantes = await buscarDeclarantes(texto);

  Helper.mostrarSugerencias(input, declarantes, 'dni', input, 'dni');

  const list = input.parentElement.querySelector('.a-autocomplete__box');
  const ul = list.querySelector('ul');

  ul.onclick = (e) => {
    input.value = e.target.dataset.text.trim();
    const declarante = JSON.parse(e.target.dataset.item);
    section.querySelector('[name="nombres"]').value = declarante['nombres'];
    section.querySelector('[name="apellido_materno"]').value = declarante['ape_materno'];
    section.querySelector('[name="apellido_paterno"]').value = declarante['ape_paterno'];

    list.classList.add('none');
  };
}

async function buscarDeclarantes(dni) {
  try {
    const res = await fetch(`../../database/obtenerDeclarantes.php?q=${encodeURIComponent(dni)}`);
    const data = await res.json();

    return data.data;
  } catch (err) {
    console.error('Error buscar declarante:', err);
    return [];
  }
}
