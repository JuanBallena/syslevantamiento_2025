window.addEventListener('load', () => {
  cargarTipoMateriales();
  cargarTipoCategorias();
});

var tipoMateriales = [];
var tipoCategorias = [];

async function cargarTipoMateriales() {
  try {
    const res = await fetch('../../database/obtenerTipoMateriales.php');
    const data = await res.json();

    tipoMateriales = data.data;
  } catch (err) {
    console.error('Error cargando tipo materiales:', err);
  }
}

async function cargarTipoCategorias() {
  try {
    const res = await fetch('../../database/obtenerTipoCategorias.php');
    const data = await res.json();

    tipoCategorias = data.data;
  } catch (err) {
    console.error('Error cargando tipo categorias:', err);
  }
}

let rowCount = 0;
async function addRow() {
  rowCount++;
  const tbody = document.querySelector('#tabla-construcciones tbody');
  const template = document.querySelector('#filaTemplate');
  const clone = template.content.cloneNode(true);

  clone.querySelectorAll('select, input').forEach((input, index) => {
    input.id = `fila${rowCount}_col${index + 1}`;
  });

  tbody.appendChild(clone);

  const newRow = tbody.lastElementChild;
  const selectMEP = newRow.querySelector('.select-mep');
  const selectECS = newRow.querySelector('.select-ecs');
  const selectECC = newRow.querySelector('.select-ecc');
  const selectMurosColumnas = newRow.querySelector('.select-muros-columnas');
  const selectTechos = newRow.querySelector('.select-techos');
  const selectPisos = newRow.querySelector('.select-pisos');
  const selectPuertasVentanas = newRow.querySelector('.select-puertas-ventanas');

  Helper.llenarSelect(selectMEP, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  Helper.llenarSelect(selectECS, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  Helper.llenarSelect(selectECC, tipoMateriales, 'i_cod_tip_material', 'c_des_tip_material');
  Helper.llenarSelect(
    selectMurosColumnas,
    tipoCategorias,
    'i_cod_tip_categoria',
    'c_des_tip_categoria'
  );
  Helper.llenarSelect(selectTechos, tipoCategorias, 'i_cod_tip_categoria', 'c_des_tip_categoria');
  Helper.llenarSelect(selectPisos, tipoCategorias, 'i_cod_tip_categoria', 'c_des_tip_categoria');
  Helper.llenarSelect(
    selectPuertasVentanas,
    tipoCategorias,
    'i_cod_tip_categoria',
    'c_des_tip_categoria'
  );
}
