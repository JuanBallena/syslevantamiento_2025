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
    if (
      e.target.classList.contains('autocompletado-dni') ||
      e.target.classList.contains('autocompletado-dni')
    ) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);
