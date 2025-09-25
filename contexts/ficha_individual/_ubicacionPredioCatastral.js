window.addEventListener('load', () => {
  cargarEstadoUnidades();
  cargarHabilitacionesUrbanas();
});

async function cargarEstadoUnidades() {
  try {
    const res = await fetch('../../database/obtenerEstadoUnidades.php');
    const data = await res.json();

    const select = document.getElementById('select-estado-unidades');
    select.innerHTML = '';

    let options = `<option value="0" selected>Seleccione</option>`;

    if (data.success && data.data.length > 0) {
      for (const item of data.data) {
        options += `<option value="${item.i_cod_est_unid}">${item.c_des_est_unid}</option>`;
      }
    }

    select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando estado unidades:', err);
  }
}

var habilitacionesUrbanas = [];
var habilitacionesUrbanasFiltradas = [];

async function cargarHabilitacionesUrbanas() {
  try {
    const res = await fetch('../../database/obtenerHabilitacionesUrbanas.php');
    const data = await res.json();

    habilitacionesUrbanas = data.data;

    crearListaHabilitacionesUrbanas();
  } catch (err) {
    console.error('Error cargando habilitaciones urbanas:', err);
  }
}

function crearListaHabilitacionesUrbanas() {
  const lista = document.getElementById('autocompletado-lista-habilitaciones-urbanas');
  lista.innerHTML = '';

  if (habilitacionesUrbanas.length > 0) {
    for (const item of habilitacionesUrbanas) {
      const li = `
        <li class="py-1 px-4 hover:bg-success" 
          data-value="${item.id_hab_urba}" 
          data-text="${item.nomb_hab_urba}"
        >                                                                     
            ${item.nomb_hab_urba}
        </li>
      `;

      lista.innerHTML += li;
    }
  }
}

function filtrarLista(texto, lista, campo) {
  if (!texto) return lista;
  return lista.filter((item) => {
    const valor = item[campo] ?? '';
    return valor.toLowerCase().includes(texto.toLowerCase());
  });
}

function mostrarSugerencias(input, lista, campoTexto, inputHidden, campoValue = 'id') {
  const contenedor = input.parentElement.querySelector('.a-autocomplete__box');
  const ul = contenedor.querySelector('ul');
  ul.innerHTML = '';

  if (lista.length > 0) {
    lista.forEach((item) => {
      const li = document.createElement('li');
      li.className = 'py-1 px-4 hover:bg-success';
      li.dataset.value = item[campoValue];
      li.dataset.text = item[campoTexto];
      li.textContent = item[campoTexto];
      ul.appendChild(li);
    });
  } else {
    const li = document.createElement('li');
    li.className = 'py-1 px-4';
    li.dataset.disabled = 'true';
    li.textContent = 'Sin resultados';
    ul.appendChild(li);
  }

  contenedor.classList.remove('none');

  ul.onclick = (e) => {
    if (e.target.tagName === 'LI' && e.target.dataset.disabled !== 'true') {
      input.value = e.target.dataset.text;
      inputHidden.value = e.target.dataset.value;
      contenedor.classList.add('none');
    }
  };
}

document.addEventListener('click', (e) => {
  if (e.target.classList.contains('input-text-habilitacion-urbana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-habilitacion-urbana');

    mostrarSugerencias(input, habilitacionesUrbanas, 'nomb_hab_urba', hiddenInput, 'id_hab_urba');
  }
});

document.addEventListener('keyup', (e) => {
  if (e.target.classList.contains('input-text-habilitacion-urbana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-habilitacion-urbana');
    const texto = input.value;
    const resultados = filtrarLista(texto, habilitacionesUrbanas, 'nomb_hu');
    mostrarSugerencias(input, resultados, 'nomb_hu', hiddenInput, 'id_hu');
  }
});

document.addEventListener(
  'blur',
  (e) => {
    if (e.target.classList.contains('input-text-habilitacion-urbana')) {
      const contenedor = e.target.parentElement.querySelector('.a-autocomplete__box');
      setTimeout(() => contenedor.classList.add('none'), 200);
    }
  },
  true
);

function onChangeGrupoHU() {
  const select = document.getElementById('select-grupo-HU');
  const inputNumber = document.getElementById('input-number-numero-etapa');

  const isEditable = select.value === '03';

  inputNumber.classList.toggle('disabled', isEditable);
  inputNumber.classList.toggle('disabled', !isEditable);

  inputNumber.readOnly = !isEditable;
  inputNumber.disabled = !isEditable;

  if (!isEditable) {
    inputNumber.value = 0;
  }
}
