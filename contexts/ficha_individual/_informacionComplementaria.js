window.addEventListener('load', () => {
  cargarCondicionesDeclarantes();
  cargarEstadosFichas();
  cargarMantenimientos();
});

async function cargarCondicionesDeclarantes() {
  try {
    const res = await fetch('../../database/obtenerCondicionesDeclarantes.php');
    const data = await res.json();

    const select = document.getElementById('select-condiciones-declarantes');
    Helper.llenarSelect(select, data.data, 'c_cod_tipo_condicion', 'c_desc_tipo_condicion');
    // select.innerHTML = '';

    // let options = Helper.generarOpciones(
    //   data.data,
    //   'c_cod_tipo_condicion',
    //   'c_desc_tipo_condicion'
    // );

    // select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando condiciones declarantes:', err);
  }
}

async function cargarEstadosFichas() {
  try {
    const res = await fetch('../../database/obtenerEstadosFichas.php');
    const data = await res.json();

    const select = document.getElementById('select-estados-fichas');
    Helper.llenarSelect(select, data.data, 'c_cod_estado_ficha', 'c_desc_estado_ficha');

    // select.innerHTML = '';

    // let options = Helper.generarOpciones(data.data, 'c_cod_estado_ficha', 'c_desc_estado_ficha');

    // select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando estados de fichas:', err);
  }
}

async function cargarMantenimientos() {
  try {
    const res = await fetch('../../database/obtenerMantenimientos.php');
    const data = await res.json();

    const select = document.getElementById('select-mantenimientos');
    Helper.llenarSelect(select, data.data, 'c_cod_mantenimiento', 'c_desc_mantenimiento');
    // select.innerHTML = '';

    // let options = Helper.generarOpciones(data.data, 'c_cod_mantenimiento', 'c_desc_mantenimiento');

    // select.innerHTML = options;
  } catch (err) {
    console.error('Error cargando mantenimientos:', err);
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
  if (value == '') {
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
