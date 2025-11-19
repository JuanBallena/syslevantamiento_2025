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

document.addEventListener('keyup', async (e) => {
  if (e.target.classList.contains('autocompletado-dni')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-dni');

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
    mostrarSugerenciasPersonas(input, resultados, 'nombres', hiddenInput, 'nume_doc');

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

async function buscarDeclarante(input) {
  const dni = input.value;
  const section = document.getElementById('datos-declarante');

  const existeDeclaranteCheckbox = section.querySelector('input[name="existe_declarante"]');
  existeDeclaranteCheckbox.checked = false;

  if (dni.length < 8) {
    section.querySelector('[name="nombres"]').value = '';
    section.querySelector('[name="ape_materno"]').value = '';
    section.querySelector('[name="ape_paterno"]').value = '';
  }

  let declarantes = await buscarDeclarantePorDni(dni);

  Helper.mostrarSugerencias(input, declarantes, 'dni', input, 'dni');

  const list = input.parentElement.querySelector('.a-autocomplete__box');
  const ul = list.querySelector('ul');

  ul.onclick = (e) => {
    input.value = e.target.dataset.text.trim();
    const declarante = JSON.parse(e.target.dataset.item);
    section.querySelector('[name="nombres"]').value = declarante['nombres'];
    section.querySelector('[name="ape_materno"]').value = declarante['ape_materno'];
    section.querySelector('[name="ape_paterno"]').value = declarante['ape_paterno'];

    list.classList.add('none');
    existeDeclaranteCheckbox.checked = true;
  };
}

async function buscarDeclarantePorDni(dni) {
  try {
    const res = await fetch(`../../database/obtenerDeclarantes.php?q=${encodeURIComponent(dni)}`);
    const data = await res.json();

    return data.data;
  } catch (err) {
    console.error('Error buscar declarante:', err);
    return [];
  }
}

function mostrarSugerenciasPersonas(input, lista, campoTexto, inputHidden, campoValue = 'id') {
  const contenedor = input.parentElement.querySelector('.a-autocomplete__box');
  const ul = contenedor.querySelector('ul');
  ul.innerHTML = '';

  if (lista.length > 0) {
    lista.forEach((item) => {
      const li = document.createElement('li');
      li.className = 'py-1 px-4 hover:bg-success';
      li.dataset.value = item[campoValue];
      li.dataset.text = `${item[campoTexto]} ${item['ape_paterno']} ${item['ape_materno']}`;
      li.dataset.item = JSON.stringify(item);

      li.textContent = li.dataset.text;
      ul.appendChild(li);
    });
  } else {
    const li = document.createElement('li');
    li.className = 'py-1 px-4';
    li.dataset.disabled = 'true';
    li.textContent = 'Sin opciones';
    ul.appendChild(li);
  }

  contenedor.classList.remove('none');

  ul.onclick = (e) => {
    if (e.target.tagName === 'LI' && e.target.dataset.disabled !== 'true') {
      input.value = e.target.dataset.text.trim();
      inputHidden.value = e.target.dataset.value;
      contenedor.classList.add('none');
    }
  };
}
