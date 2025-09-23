const titulares = { naturales: [], juridicas: [] };

const contenedorNaturales = document.getElementById('contenedor-naturales');
const contenedorJuridicas = document.getElementById('contenedor-juridicas');

// --- Persona Natural ---
function crearFormularioNatural(index) {
  return `
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="natural">
        <h4 class="col-span-3 font-bold">Persona Natural ${index + 1}</h4>
        
        <div>
          <label>Estado Civil</label>
          <select class="a-input-text input-estado-civil">
            <option value="01">Soltero(a)</option>
            <option value="02">Casado(a)</option>
            <option value="03">Divorciado(a)</option>
            <option value="04">Viudo(a)</option>
            <option value="05">Conviviente</option>
          </select>
        </div>

        <div>
          <label>Tipo Doc. Identidad</label>
          <select class="a-input-text input-tipo-doc">
            <option value="01">No Presentó Documento</option>
            <option value="02">DNI</option>
            <option value="03">Carnet Policía</option>
            <option value="04">Carnet Fuerzas Armadas</option>
            <option value="05">Partida de Nacimiento</option>
            <option value="06">Pasaporte</option>
            <option value="07">Carnet de Extranjería</option>
            <option value="08">Otros</option>
          </select>
        </div>

        <div>
          <label>N° Documento</label>
          <input type="text" class="a-input-text input-num-doc" />
        </div>
        <div>
          <label>Nombres</label>
          <input type="text" class="a-input-text input-nombres" />
        </div>
        <div>
          <label>Apellido Paterno</label>
          <input type="text" class="a-input-text input-apellido-paterno" />
        </div>
        <div>
          <label>Apellido Materno</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
        <div>
          <div class="wrapper-checkbox mt-4">
            <label class="custom-checkbox">
              <input name="" type="checkbox" id="" class="chk-sin-doc" />
              <span class="checkmark"></span>
            </label>
            <span class="pl-2">Sin Nro. Doc.</span>
          </div>
        </div>
      </div>`;
}

// --- Persona Jurídica ---
function crearFormularioJuridica(index) {
  return `
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="juridica">
        <h4 class="col-span-3 font-bold">Persona Jurídica ${index + 1}</h4>
        
        <div>
          <label>N° RUC</label>
          <input type="text" class="a-input-text input-ruc" />
        </div>
        <div class="col-span-2">
          <label>Razón Social</label>
          <input type="text" class="a-input-text input-razon-social" />
        </div>
        <div>
          <label>Persona Jurídica</label>
          <select class="a-input-text input-tipo-pj">
            <option value="01">Empresa</option>
            <option value="02">Cooperativa</option>
            <option value="03">Asociación</option>
            <option value="04">Fundación</option>
            <option value="05">Otros</option>
          </select>
        </div>
      </div>`;
}

// --- Eventos para añadir ---
document.getElementById('btn-add-natural').addEventListener('click', () => {
  const index = contenedorNaturales.querySelectorAll('[data-tipo="natural"]').length;
  contenedorNaturales.insertAdjacentHTML('beforeend', crearFormularioNatural(index));

  activarEventos();
});

document.getElementById('btn-add-juridica').addEventListener('click', () => {
  const index = contenedorJuridicas.querySelectorAll('[data-tipo="juridica"]').length;
  contenedorJuridicas.insertAdjacentHTML('beforeend', crearFormularioJuridica(index));
});

// --- Recolectar todos los titulares ---
function recolectarTitulares() {
  titulares.naturales = [];
  titulares.juridicas = [];

  contenedorNaturales.querySelectorAll("[data-tipo='natural']").forEach((bloque) => {
    titulares.naturales.push({
      estado_civil: bloque.querySelector('.input-estado-civil').value,
      tipo_doc: bloque.querySelector('.input-tipo-doc').value,
      num_doc: bloque.querySelector('.input-num-doc').value,
      nombres: bloque.querySelector('.input-nombres').value,
      apellido_paterno: bloque.querySelector('.input-apellido-paterno').value,
      apellido_materno: bloque.querySelector('.input-apellido-materno').value,
      sin_doc: bloque.querySelector('.chk-sin-doc').value,
    });
  });

  contenedorJuridicas.querySelectorAll("[data-tipo='juridica']").forEach((bloque) => {
    titulares.juridicas.push({
      ruc: bloque.querySelector('.input-ruc').value,
      razon_social: bloque.querySelector('.input-razon-social').value,
      tipo_pj: bloque.querySelector('.input-tipo-pj').value,
    });
  });

  console.log('Titulares agrupados:', titulares);
  return titulares;
}

function activarEventos() {
  // Natural
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
