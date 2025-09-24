window.addEventListener('load', () => {
  cargarTipoVias();
  cargarHabilitacionesUrbanas();
});
var tipoVias = [];

const titulares = { naturales: [], juridicas: [] };

async function cargarTipoVias() {
  try {
    const res = await fetch('../../database/obtenerTipoVias.php');
    const data = await res.json();
    tipoVias = data.data;
  } catch (err) {
    console.error('Error cargando tipo vias:', err);
  }
}

var habilitacionesUrbanas = [];
var habilitacionesUrbanasFiltradas = [];

async function cargarHabilitacionesUrbanas() {
  try {
    const res = await fetch('../../database/obtenerHabilitacionesUrbanas.php');
    const data = await res.json();

    habilitacionesUrbanas = data.data;

    crearListaHabilitacionesUrbanas(habilitacionesUrbanas);
  } catch (err) {
    console.error('Error cargando habilitaciones urbanas:', err);
  }
}

const contenedorNaturales = document.getElementById('contenedor-naturales');
const contenedorJuridicas = document.getElementById('contenedor-juridicas');

// --- Persona Natural ---
function crearFormularioNatural(index) {
  return `
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="natural">
        <h4 class="col-span-3 font-bold">
          Persona Natural ${index + 1}

          <div class="a-close-button is-danger-color btn-eliminar-puerta">x</div>
        </h4>
        
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
      </div>
      <div class="grid grid-cols-4 gap-x-2 border p-2" data-tipo="domicilio">
        <div>
          <label>Ubicación</label>
          <select class="a-input-text input-ubicacion">
            <option value="01">Igual a UU.CC</option>
            <option value="02">Otros</option>
          </select>
        </div>
        <div>
          <label>Departamento</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
        <div>
          <label>Provincia</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
        <div>
          <label>Distrito</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
      </div>
      <div class="o-grid o-grid__five-columns">
        <div class="o-grid__first-column">        
          <label>Tipo de Vía</label>
            <div class="a-autocomplete">
              <input type="text" 
                 class="a-input-text input-tipo-via"                  
                 placeholder="Escriba" />
              <input type="hidden" class="input-hidden-tipo-via" />
              <div class="a-autocomplete__box none contenedor-tipo-vias">
                <ul class="a-autocomplete__items lista-tipo-vias"></ul>
              </div>
            </div>  
        </div>  
        <div class="o-grid__second-column">
          <label>Nombre Vía</label>
          <input type="text" class="a-input-text input-nombre-via" />
        </div>
      </div>
      <div class="grid grid-cols-2 gap-x-2 border p-2" data-tipo="domicilio">    
        <div>
            <label>Nro. Municipal</label>
            <input class="a-input-text puerta-numero" type="text" />
        </div>
        <div>
            <label>Nro. Interior</label>
            <input class="a-input-text puerta-interior" type="text" />
        </div>      
        <div>
          <label>Nombre de Habilitación Urbana</label> 
            <input type="text" class="a-input-text input-nombre-hu" />
        </div>
        <div>
          <label>Grupo HU</label>
          <select class="a-input-text input-grupo">
            <option value="01">Zona</option>
            <option value="02">Sector</option>
            <option value="03">Etapa</option>
          </select>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="domicilio"> 
        <div>
          <label>Manzana</label>
          <input type="text" class="a-input-text input-manzana" />
        </div>
        <div>
          <label>Lote</label>
          <input type="text" class="a-input-text input-lote" />
        </div>
        <div>
          <label>SubLote</label>
          <input type="text" class="a-input-text input-sublote" />
        </div> 
        <div>
          <label>Telefono</label>
          <input type="text" class="a-input-text input-telefono" />
        </div>
        <div>
          <label>Anexo</label>
          <input type="text" class="a-input-text input-anexo" />
        </div>
        <div>
          <label>Correo Electrónico</label>
          <input type="text" class="a-input-text input-correo" />
        </div>
      </div>
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="caracteristicas">
        <div>
          <label>Condición Titular</label>
          <select class="a-input-text input-condicion">
            <option value="01">Propietario Único</option>
            <option value="02">Sucesión intestada</option>
            <option value="03">Poseedor</option>
            <option value="04">Sociedad Conyugal</option>
            <option value="05">Cotitularidad</option>
            <option value="06">Litigio</option>
            <option value="07">Otros</option>
          </select>
        </div>  
        <div>
          <label>Forma de Adquisición</label>
          <select class="a-input-text input-condicion">
            <option value="01">Compra Venta</option>
            <option value="02">Antic Legitima</option>
            <option value="03">Testamento</option>
            <option value="04">Donación</option>
            <option value="05">Adjudicación</option>
            <option value="06">Fusión</option>
            <option value="07">Expropiación</option>
            <option value="08">Permuta</option>
            <option value="09">Prescripción Adqui</option>
            <option value="10">Ces. Der/Acciones</option>
            <option value="11">Dacion pago</option>
            <option value="12">Decl. Herederos</option>
            <option value="13">Posesion</option>
            <option value="14">Otros</option>
          </select>
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
      </div>
      <div class="grid grid-cols-4 gap-x-2 border p-2" data-tipo="domicilio">
        <div>
          <label>Ubicación</label>
          <select class="a-input-text input-ubicacion">
            <option value="01">Igual a UU.CC</option>
            <option value="02">Otros</option>
          </select>
        </div>
        <div>
          <label>Departamento</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
        <div>
          <label>Provincia</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
        <div>
          <label>Distrito</label>
          <input type="text" class="a-input-text input-apellido-materno" />
        </div>
      </div>
      <div class="o-grid o-grid__five-columns">
        <div class="o-grid__first-column">        
          <label>Tipo de Vía</label>
            <div class="a-autocomplete">
              <input type="text" 
                 class="a-input-text input-tipo-via"                  
                 placeholder="Escriba" />
              <input type="hidden" class="input-hidden-tipo-via" />
              <div class="a-autocomplete__box none contenedor-tipo-vias">
                <ul class="a-autocomplete__items lista-tipo-vias"></ul>
              </div>
            </div>  
        </div>  
        <div class="o-grid__second-column">
          <label>Nombre Vía</label>
          <input type="text" class="a-input-text input-nombre-via" />
        </div>
      </div>
      <div class="grid grid-cols-2 gap-x-2 border p-2" data-tipo="domicilio">    
        <div>
            <label>Nro. Municipal</label>
            <input class="a-input-text puerta-numero" type="text" />
        </div>
        <div>
            <label>Nro. Interior</label>
            <input class="a-input-text puerta-interior" type="text" />
        </div>      
        <div>
          <label>Nombre de Habilitación Urbana</label> 
            <input type="text" class="a-input-text input-nombre-hu" />
        </div>
        <div>
          <label>Grupo HU</label>
          <select class="a-input-text input-grupo">
            <option value="01">Zona</option>
            <option value="02">Sector</option>
            <option value="03">Etapa</option>
          </select>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="domicilio"> 
        <div>
          <label>Manzana</label>
          <input type="text" class="a-input-text input-manzana" />
        </div>
        <div>
          <label>Lote</label>
          <input type="text" class="a-input-text input-lote" />
        </div>
        <div>
          <label>SubLote</label>
          <input type="text" class="a-input-text input-sublote" />
        </div> 
        <div>
          <label>Telefono</label>
          <input type="text" class="a-input-text input-telefono" />
        </div>
        <div>
          <label>Anexo</label>
          <input type="text" class="a-input-text input-anexo" />
        </div>
        <div>
          <label>Correo Electrónico</label>
          <input type="text" class="a-input-text input-correo" />
        </div>
      </div>
      <div class="grid grid-cols-3 gap-x-2 border p-2" data-tipo="caracteristicas">
        <div>
          <label>Condición Titular</label>
          <select class="a-input-text input-condicion">
            <option value="01">Propietario Único</option>
            <option value="02">Sucesión intestada</option>
            <option value="03">Poseedor</option>
            <option value="04">Sociedad Conyugal</option>
            <option value="05">Cotitularidad</option>
            <option value="06">Litigio</option>
            <option value="07">Otros</option>
          </select>
        </div>  
        <div>
          <label>Forma de Adquisición</label>
          <select class="a-input-text input-condicion">
            <option value="01">Compra Venta</option>
            <option value="02">Antic Legitima</option>
            <option value="03">Testamento</option>
            <option value="04">Donación</option>
            <option value="05">Adjudicación</option>
            <option value="06">Fusión</option>
            <option value="07">Expropiación</option>
            <option value="08">Permuta</option>
            <option value="09">Prescripción Adqui</option>
            <option value="10">Ces. Der/Acciones</option>
            <option value="11">Dacion pago</option>
            <option value="12">Decl. Herederos</option>
            <option value="13">Posesion</option>
            <option value="14">Otros</option>
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
