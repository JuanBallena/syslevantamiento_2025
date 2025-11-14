const contenedorNaturales = document.getElementById('contenedor-personas-naturales');
const contenedorJuridicas = document.getElementById('contenedor-personas-juridicas');

let listaFormularios = [];

async function cargarFormularioTitular() {
  const tipoTitular = document.querySelector(
    "#identificacion-titular-catastral select[name='tipo_titular']"
  ).value;
  contenedorNaturales.innerHTML = '';
  contenedorJuridicas.innerHTML = '';

  if (tipoTitular === '01') {
    contenedorNaturales.insertAdjacentHTML('beforeend', await crearFormularioPersonaNatural(0));
  } else if (tipoTitular === '02') {
    contenedorJuridicas.insertAdjacentHTML('beforeend', await crearFormularioPersonaJuridica(0));
  }
  activarEventos();
}

async function crearFormularioPersonaNatural(index) {
  const id = Helper.generarId();

  listaFormularios.push({ id: id });

  const placeholders = {
    '{{id}}': id,
    '{{index}}': index + 1,
    '{{estadoCivilOpciones}}': Helper.generarOpciones(DataSelect.estadoCivilOpciones),
    '{{tipoDocumentoOpciones}}': Helper.generarOpciones(DataSelect.tipoDocumentoOpciones),
    '{{ubicacionOpciones}}': Helper.generarOpciones(DataSelect.ubicacionOpciones),
    '{{grupoHUOpciones}}': Helper.generarOpciones(DataSelect.grupoHUOpciones),
    '{{condicionTitularOpciones}}': Helper.generarOpciones(DataSelect.condicionTitularOpciones),
    '{{formaAdquisicionOpciones}}': Helper.generarOpciones(DataSelect.formaAdquisicionOpciones),
  };

  const res = await fetch('FormularioPersonaNatural.html');
  let html = await res.text();

  for (const [key, value] of Object.entries(placeholders)) {
    html = html.replace(key, value);
  }

  return html;
}

async function crearFormularioPersonaJuridica(index) {
  const id = Helper.generarId();

  listaFormularios.push({ id: id });

  const placeholders = {
    '{{id}}': id,
    '{{index}}': index + 1,
    '{{personaJuridicaOpciones}}': Helper.generarOpciones(DataSelect.personaJuridicaOpciones),
    '{{ubicacionOpciones}}': Helper.generarOpciones(DataSelect.ubicacionOpciones),
    '{{grupoHUOpciones}}': Helper.generarOpciones(DataSelect.grupoHUOpciones),
    '{{condicionTitularOpciones}}': Helper.generarOpciones(DataSelect.condicionTitularOpciones),
    '{{formaAdquisicionOpciones}}': Helper.generarOpciones(DataSelect.formaAdquisicionOpciones),
  };

  const res = await fetch('FormularioPersonaJuridica.html');
  let html = await res.text();

  for (const [key, value] of Object.entries(placeholders)) {
    html = html.replace(key, value);
  }

  return html;
}

function activarEventos() {
  // ⭐ Nuevo: controlar estado civil
  document.querySelectorAll('.input-estado-civil').forEach((select) => {
    select.onchange = () => manejarEstadoCivil(select);
  });

  // Evento para el checkbox "sin documento"
  document.querySelectorAll('.chk-sin-doc').forEach((chk) => {
    chk.onchange = () => {
      const bloque = chk.closest("[data-tipo='natural']");
      const selectDoc = bloque.querySelector('.input-tipo-doc');
      const inputNum = bloque.querySelector('.input-num-doc');

      if (chk.checked) {
        selectDoc.value = '01';
        inputNum.value = '';
        inputNum.disabled = true;
      } else {
        inputNum.disabled = false;
      }
    };
  });
}

async function manejarEstadoCivil(select) {
  const valor = select.value;

  // Buscar si ya existe el formulario de pareja
  const formPareja = document.querySelector("[data-tipo='pareja']");

  // CASADO o CONVIVIENTE → debe existir
  if (valor === '02' || valor === '05') {
    // Si NO existe, crearlo
    if (!formPareja) {
      const bloqueNatural = select.closest("[data-tipo='natural']");
      const htmlPareja = await crearFormularioPareja();

      bloqueNatural.insertAdjacentHTML('afterend', htmlPareja);

      activarEventos(); // Reactivar eventos dentro del nuevo bloque
    }
  } else {
    // Cualquier otro estado civil → eliminar si existe
    if (formPareja) {
      formPareja.remove();
    }
  }
}

async function crearFormularioPareja() {
  const id = Helper.generarId();

  const placeholders = {
    '{{id}}': id,
    '{{index}}': 'Pareja',
    '{{estadoCivilOpciones}}': Helper.generarOpciones(DataSelect.estadoCivilOpciones),
    '{{tipoDocumentoOpciones}}': Helper.generarOpciones(DataSelect.tipoDocumentoOpciones),
    '{{ubicacionOpciones}}': Helper.generarOpciones(DataSelect.ubicacionOpciones),
    '{{grupoHUOpciones}}': Helper.generarOpciones(DataSelect.grupoHUOpciones),
    '{{condicionTitularOpciones}}': Helper.generarOpciones(DataSelect.condicionTitularOpciones),
    '{{formaAdquisicionOpciones}}': Helper.generarOpciones(DataSelect.formaAdquisicionOpciones),
  };

  let res = await fetch('FormularioPareja.html');
  let html = await res.text();

  for (const [key, value] of Object.entries(placeholders)) {
    html = html.replace(key, value);
  }

  // Cambiar el tipo del formulario
  html = html.replace(`data-tipo="natural"`, `data-tipo="pareja"`);

  return html;
}

document.addEventListener('click', (e) => {
  if (e.target.classList.contains('btn-eliminar')) {
    const id = e.target.closest('[data-id]').dataset.id;
    eliminarFormulario(id);
  }
});

function eliminarFormulario(id) {
  listaFormularios = listaFormularios.filter((l) => l.id !== id);
  document.querySelector(`[data-id="${id}"]`)?.remove();
}
