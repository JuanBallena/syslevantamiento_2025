window.addEventListener('load', () => {
  cargarCondicionDeclarantes();
  cargarEstadoFichas();
  cargarMantenimiento();
});

async function cargarCondicionDeclarantes() {
  try {
    const res = await fetch('../../database/obtenerCondicionesDeclarantes.php');
    const data = await res.json();

    const select = document.getElementById('select-condicion-declarante');
    select.innerHTML = '';

    let options = `<option value="0" selected>Seleccione</option>`;

    if (data.success && data.data.length > 0) {
      for (const item of data.data) {
        options += `<option value="${item.c_cod_tipo_condicion}">${item.c_desc_tipo_condicion}</option>`;
      }
    }

    select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando condición declarante:', err);
  }
}

async function cargarEstadoFichas() {
  try {
    const res = await fetch('../../database/obtenerEstadosFichas.php');
    const data = await res.json();

    const select = document.getElementById('select-estado-ficha');
    select.innerHTML = '';

    let options = `<option value="0" selected>Seleccione</option>`;

    if (data.success && data.data.length > 0) {
      for (const item of data.data) {
        options += `<option value="${item.c_cod_estado_ficha}">${item.c_desc_estado_ficha}</option>`;
      }
    }

    select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando estado de fichas:', err);
  }
}

async function cargarMantenimiento() {
  try {
    const res = await fetch('../../database/obtenerMantenimientos.php');
    const data = await res.json();

    const select = document.getElementById('select-mantenimiento');
    select.innerHTML = '';

    let options = `<option value="0" selected>Seleccione</option>`;

    if (data.success && data.data.length > 0) {
      for (const item of data.data) {
        options += `<option value="${item.c_cod_mantenimiento}">${item.c_desc_mantenimiento}</option>`;
      }
    }

    select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando mantenimiento:', err);
  }
}

function setValueCheckboxSubdivision(value) {
  if (value) {
    document.getElementById('sb_sub').checked = true;
  }
}

function setValueCheckboxAcumulacion(value) {
  if (value) {
    document.getElementById('sb_acu').checked = true;
  }
}

function setValueCheckboxIndependizacion(value) {
  if (value) {
    document.getElementById('sb_ind').checked = true;
  }
}

function validar_ceros(value) {
  if ((value = '')) {
    return 0;
  }
}

function loadInputValuesAdditionalInformation(cantidadMedidores) {
  document.getElementById('input-cant_med').value = cantidadMedidores;
}

function loadInputValuesAdditionalInformation(cantidadHabitantes) {
  document.getElementById('input-cant_hab').value = cantidadHabitantes;
}

function loadInputValuesAdditionalInformation(cantidadFamilias) {
  document.getElementById('input-cant_fam').value = cantidadFamilias;
}
