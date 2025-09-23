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

    crearListaHabilitacionesUrbanas(habilitacionesUrbanas);
  } catch (err) {
    console.error('Error cargando habilitaciones urbanas:', err);
  }
}

function crearListaHabilitacionesUrbanas(items) {
  const lista = document.getElementById('autocompletado-lista-habilitaciones-urbanas');
  lista.innerHTML = '';

  if (items.length > 0) {
    for (const item of items) {
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

    lista.addEventListener('click', (e) => {
      if (e.target.tagName === 'LI') {
        if (e.target.dataset.disabled === 'true') return;
        document.getElementById('input-text-habilitacion-urbana').value = e.target.dataset.text;
        document.getElementById('input-hidden-habilitacion-urbana').value = e.target.dataset.value;

        const contenedor = document.getElementById(
          'autocompletado-contenedor-habilitaciones-urbanas'
        );
        contenedor.classList.add('none');
      }
    });
  } else {
    const li = `<li class="py-1 px-4" data-disabled="true">Sin resultados</li>`;

    lista.innerHTML += li;
  }
}

function onClickAutocompletadoHabilitacionesUrbanas() {
  const contenedor = document.getElementById('autocompletado-contenedor-habilitaciones-urbanas');
  contenedor.classList.toggle('none');
}

function onBlurAutocompletadoHabilitacionesUrbanas() {
  const contenedor = document.getElementById('autocompletado-contenedor-habilitaciones-urbanas');
  contenedor.classList.add('none');
}

function onKeyupAutocompletadoHabilitacionesUrbanas(event) {
  let text = event.target.value;

  habilitacionesUrbanasFiltradas = habilitacionesUrbanas.filter((item) => {
    return item['nomb_hab_urba'].includes(text);
  });

  crearListaHabilitacionesUrbanas(habilitacionesUrbanasFiltradas);
}

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

// function loadInputValuesCatastralPropertyLocation(hu, manzana, lote, sublote, numEtapa) {
//   document.getElementById('urban-authorization-name-text').value = hu.nombre.trim();
//   document.getElementById('urban-authorization-name-value').value = hu.codurba;
//   document.getElementById('input-mzna-Dist').value = manzana;
//   document.getElementById('input-lote-Dist').value = lote;
//   document.getElementById('input-subLote-Dist').value = sublote;
//   document.getElementById('stage-number').value = numEtapa;
// }

// function loadInputValuesCatastralPropertyLocation_I(hu) {
//   document.getElementById('urban-authorization-name-text').value = hu.nombre.trim();
//   document.getElementById('urban-authorization-name-value').value = hu.codurba;
// }

// function createOptionsHuGroup(fichaGroupHus, GroupHus) {
//   const selectGroupHus = document.getElementById('select-grupoHU');
//   const fichaGroupHu = fichaGroupHus;

//   let option = `<option value="">Seleccione</option>`;
//   selectGroupHus.innerHTML += option;

//   for (const groupHu of GroupHus) {
//     let option = '';

//     if (groupHu.c_cod_tip_zce == fichaGroupHu.c_cod_tip_zce) {
//       option = `<option value="${fichaGroupHu.c_cod_tip_zce}" selected>${fichaGroupHu.c_desc_tip_zce}</option>`;
//     } else {
//       option = `<option value="${groupHu.c_cod_tip_zce}">${groupHu.c_desc_tip_zce}</option>`;
//     }

//     selectGroupHus.innerHTML += option;
//   }
// }
