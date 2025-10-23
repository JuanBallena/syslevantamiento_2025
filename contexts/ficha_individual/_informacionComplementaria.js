window.addEventListener('load', () => {
  cargarCondicionesDeclarantes();
  cargarEstadosFichas();
  cargarMantenimientos();
});

async function cargarCondicionesDeclarantes() {
  try {
    const res = await fetch('../../database/obtenerCondicionesDeclarantes.php');
    const data = await res.json();

    // console.log('condicion declarante');
    // console.log(data.data);

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

    // console.log('estado ficha');
    // console.log(data.data);

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

    // console.log('mantenimiento');
    // console.log(data.data);

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

// Identificación de los litigantes

let filaTablaLitigantes = 0;
async function agregarFilaTablaLitigantes() {
  filaTablaLitigantes++;
  const tbody = document.querySelector('#tabla-litigantes tbody');
  const template = document.querySelector('#filaTablaLitigantes');
  const clone = template.content.cloneNode(true);

  clone.querySelectorAll('select, input').forEach((input, index) => {
    input.id = `fila${filaTablaLitigantes}_col${index + 1}`;
  });

  tbody.appendChild(clone);

  const newRow = tbody.lastElementChild;
  // const selectMEP = newRow.querySelector('.select-mep');
  // const selectECS = newRow.querySelector('.select-ecs');
  // const selectECC = newRow.querySelector('.select-ecc');
  // const selectMurosColumnas = newRow.querySelector('.select-muros-columnas');
  // const selectTechos = newRow.querySelector('.select-techos');
  // const selectPisos = newRow.querySelector('.select-pisos');
  // const selectPuertasVentanas = newRow.querySelector('.select-puertas-ventanas');

  // Helper.llenarSelect(selectMEP, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  // Helper.llenarSelect(selectECS, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  // Helper.llenarSelect(selectECC, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  // Helper.llenarSelect(
  //   selectMurosColumnas,
  //   tipoCategorias,
  //   'i_cod_tip_categoria',
  //   'c_des_tip_categoria'
  // );
  // Helper.llenarSelect(selectTechos, tipoCategorias, 'i_cod_tip_categoria', 'c_des_tip_categoria');
  // Helper.llenarSelect(selectPisos, tipoCategorias, 'i_cod_tip_categoria', 'c_des_tip_categoria');
  // Helper.llenarSelect(
  //   selectPuertasVentanas,
  //   tipoCategorias,
  //   'i_cod_tip_categoria',
  //   'c_des_tip_categoria'
  // );
}
