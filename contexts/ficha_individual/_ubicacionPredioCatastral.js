window.addEventListener('load', () => {
  cargarTipoEdificaciones();
  cargarTipoInteriores();
  // cargarEstadosUnidades();
  cargarHabilitacionesUrbanas();
});

async function cargarTipoEdificaciones() {
  try {
    const res = await fetch('../../database/obtenerTipoEdificaciones.php');
    const data = await res.json();

    const select = document.getElementById('select-tipo-edificaciones');
    select.innerHTML = '';
    Helper.llenarSelect(select, data.data, 'i_cod_tip_edificacion', 'c_des_tip_edificacion');
  } catch (err) {
    console.error('Error cargando tipo edificaciones:', err);
  }
}

async function cargarTipoInteriores() {
  try {
    const res = await fetch('../../database/obtenerTipoInteriores.php');
    const data = await res.json();

    const select = document.getElementById('select-tipo-interiores');
    Helper.llenarSelect(select, data.data, 'i_cod_tip_interior', 'c_des_tip_interior');
  } catch (err) {
    console.error('Error cargando tipo interiores:', err);
  }
}

// async function cargarEstadosUnidades() {
//   try {
//     const res = await fetch('../../database/obtenerEstadosUnidades.php');
//     const data = await res.json();

//     const select = document.getElementById('select-estado-unidades');
//     Helper.llenarSelect(select, data.data, 'i_cod_est_unid', 'c_des_est_unid');
//     // select.innerHTML = '';

//     // let options = `<option value="0" selected>Seleccione</option>`;

//     // if (data.success && data.data.length > 0) {
//     //   for (const item of data.data) {
//     //     options += `<option value="${item.i_cod_est_unid}">${item.c_des_est_unid}</option>`;
//     //   }
//     // }

//     // select.innerHTML = options;
//   } catch (err) {
//     console.error('Error cargando estado unidades:', err);
//   }
// }

var habilitacionesUrbanas = [];

async function cargarHabilitacionesUrbanas() {
  try {
    const res = await fetch('../../database/obtenerHabilitacionesUrbanas.php');
    const data = await res.json();

    habilitacionesUrbanas = data.data;
  } catch (err) {
    console.error('Error cargando habilitaciones urbanas:', err);
  }
}

// document.addEventListener('DOMContentLoaded', () => {
document.addEventListener('click', (e) => {
  if (e.target.classList.contains('input-text-habilitacion-urbana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-habilitacion-urbana');

    const section = input.closest('.m-form-section');
    const inputReadonly = section.querySelector('.codigo-habilitacion-urbana-readonly');

    Helper.mostrarSugerencias(
      input,
      habilitacionesUrbanas,
      'nomb_hab_urba',
      hiddenInput,
      'id_hab_urba',
      inputReadonly,
      'codi_hab_urba'
    );
  }
});
// });

document.addEventListener('keyup', (e) => {
  if (e.target.classList.contains('input-text-habilitacion-urbana')) {
    const input = e.target;
    const hiddenInput = input.parentElement.querySelector('.input-hidden-habilitacion-urbana');
    const texto = input.value;
    const resultados = Helper.filtrarLista(texto, habilitacionesUrbanas, 'nomb_hab_urba');

    Helper.mostrarSugerencias(input, resultados, 'nomb_hab_urba', hiddenInput, 'codi_hab_urba');
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
