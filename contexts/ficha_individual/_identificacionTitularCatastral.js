const contenedorNaturales = document.getElementById('contenedor-personas-naturales');
const contenedorJuridicas = document.getElementById('contenedor-personas-juridicas');

let listaFormularios = [];

async function crearFormularioPersonaNatural(index) {
  const id = Helper.generarId();

  listaFormularios.push({ id: id });

  const placeholders = {
    '{{id}}': id,
    '{{index}}': index + 1,
    '{{estadoCivilOpciones}}': Helper.generarOpciones(DataSelect.estadoCivilOpciones),
    '{{tipoDocumentoOpciones}}': Helper.generarOpciones(DataSelect.tipoDocumentoOpciones),
    '{{ubicacionOpciones}}': Helper.generarOpciones(DataSelect.ubicacionOpciones, false),
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
    '{{ubicacionOpciones}}': Helper.generarOpciones(DataSelect.ubicacionOpciones, false),
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

document.getElementById('btn-add-natural').addEventListener('click', async () => {
  const index = contenedorNaturales.querySelectorAll('[data-tipo="natural"]').length;
  contenedorNaturales.insertAdjacentHTML('beforeend', await crearFormularioPersonaNatural(index));

  activarEventos();
});

document.getElementById('btn-add-juridica').addEventListener('click', async () => {
  const index = contenedorJuridicas.querySelectorAll('[data-tipo="juridica"]').length;
  contenedorJuridicas.insertAdjacentHTML('beforeend', await crearFormularioPersonaJuridica(index));

  activarEventos();
});

function activarEventos() {
  document.querySelectorAll('.chk-sin-doc').forEach((chk) => {
    chk.onchange = () => {
      const bloque = chk.closest("[data-tipo='natural']");
      const selectDoc = bloque.querySelector('.input-tipo-doc');
      const inputNum = bloque.querySelector('.input-num-doc');

      if (chk.checked) {
        selectDoc.value = '01'; // "No presentó documento"
        inputNum.value = '';
        inputNum.disabled = true;
      } else {
        inputNum.disabled = false;
      }
    };
  });
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
