window.addEventListener('load', () => {
  cargarCodigosInstalaciones();
});

var codigosInstalaciones = [];

async function cargarCodigosInstalaciones() {
  try {
    const res = await fetch('../../database/obtenerCodigosInstalaciones.php');
    const data = await res.json();

    codigosInstalaciones = data.data;
  } catch (err) {
    console.error('Error cargando tipo materiales:', err);
  }
}

let filaTablaObrasComplementarias = 0;

async function agregarFilaTablaObrasComplementarias() {
  filaTablaObrasComplementarias++;
  const tbody = document.querySelector('#tabla-obras-complementarias tbody');
  const template = document.querySelector('#filaTablaObrasComplementarias');
  const clone = template.content.cloneNode(true);

  clone.querySelectorAll('select, input').forEach((input, index) => {
    input.id = `fila${filaTablaObrasComplementarias}_col${index + 1}`;
  });

  tbody.appendChild(clone);

  const newRow = tbody.lastElementChild;
  const selectCodigosInstalaciones = newRow.querySelector('.select-codigos-instalaciones');
  const selectMEP = newRow.querySelector('.select-mep');
  const selectECS = newRow.querySelector('.select-ecs');
  const selectECC = newRow.querySelector('.select-ecc');
  // const selectMurosColumnas = newRow.querySelector('.select-muros-columnas');
  // const selectTechos = newRow.querySelector('.select-techos');
  // const selectPisos = newRow.querySelector('.select-pisos');
  // const selectPuertasVentanas = newRow.querySelector('.select-puertas-ventanas');

  Helper.llenarSelect(
    selectCodigosInstalaciones,
    codigosInstalaciones,
    'codi_instalacion',
    'desc_instalacion'
  );

  // Se cargan desde las variables del archivos _construcciones.js
  Helper.llenarSelect(selectMEP, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  Helper.llenarSelect(selectECS, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  Helper.llenarSelect(selectECC, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
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
