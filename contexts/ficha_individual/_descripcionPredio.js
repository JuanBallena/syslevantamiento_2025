//////////////////////////////
// === Datos ===
//////////////////////////////
let usos = [];
let usosTimeout = null; // para controlar el delay del keyup

//////////////////////////////
// === Fetch dinámico ===
//////////////////////////////
async function cargarUsos(texto = '') {
  try {
    const res = await fetch(`../../database/obtenerUsos.php?q=${encodeURIComponent(texto)}`);
    const data = await res.json();
    usos = data.data;
    return usos;
  } catch (err) {
    console.error('Error cargando usos:', err);
    return [];
  }
}

//////////////////////////////
// === Mostrar sugerencias ===
//////////////////////////////
function mostrarSugerenciasUsos(lista) {
  const input = document.getElementById('input-text-uso');
  const hiddenInput = document.getElementById('input-hidden-uso');
  const contenedor = document.getElementById('autocompletado-contenedor-usos');
  const ul = document.getElementById('autocompletado-lista-usos');

  ul.innerHTML = '';

  if (lista.length > 0) {
    lista.forEach((item) => {
      const li = document.createElement('li');
      li.className = 'py-1 px-4 hover:bg-success';
      li.dataset.value = item.id_uso; // 👈 ajusta al campo real de tu BD
      li.dataset.text = item.nomb_uso; // 👈 ajusta al campo real de tu BD
      li.textContent = item.nomb_uso;
      ul.appendChild(li);
    });
  } else {
    const li = document.createElement('li');
    li.className = 'py-1 px-4';
    li.dataset.disabled = 'true';
    li.textContent = 'Sin resultados';
    ul.appendChild(li);
  }

  contenedor.classList.remove('none');

  // click en sugerencia
  ul.onclick = (e) => {
    if (e.target.tagName === 'LI' && e.target.dataset.disabled !== 'true') {
      input.value = e.target.dataset.text;
      hiddenInput.value = e.target.dataset.value;
      contenedor.classList.add('none');
    }
  };
}

//////////////////////////////
// === Eventos ===
//////////////////////////////

// mostrar todos al hacer click
document.getElementById('input-text-uso').addEventListener('click', async (e) => {
  const data = await cargarUsos('');
  mostrarSugerenciasUsos(data);
});

// buscar dinámico al escribir (con delay 500ms)
document.getElementById('input-text-uso').addEventListener('keyup', (e) => {
  clearTimeout(usosTimeout);
  const texto = e.target.value;

  usosTimeout = setTimeout(async () => {
    const data = await cargarUsos(texto);
    mostrarSugerenciasUsos(data);
  }, 500);
});

// ocultar al perder foco
document.getElementById('input-text-uso').addEventListener('blur', (e) => {
  const contenedor = document.getElementById('autocompletado-contenedor-usos');
  setTimeout(() => contenedor.classList.add('none'), 200);
});

// var usesAuthorizationNameValuesFromDatabase = [];

// function onclickCatastralProperty() {
//   const catastralPropertyItems = document.getElementById(
//     'uses-authorization-name-options-container'
//   );
//   catastralPropertyItems.classList.add('u-d-block');
//   catastralPropertyItems.classList.remove('u-d-none');
// }

// function onblurCatastralProperty() {
//   const catastralPropertyItems = document.getElementById(
//     'uses-authorization-name-options-container'
//   );
//   catastralPropertyItems.classList.remove('u-d-block');a
//   catastralPropertyItems.classList.add('u-d-none');
// }

// function onclickUsesAuthorizationNameItem(text, value) {
//   const catastralPropertyItems = document.getElementById(
//     'uses-authorization-name-options-container'
//   );
//   catastralPropertyItems.classList.remove('u-d-block');
//   catastralPropertyItems.classList.add('u-d-none');

//   document.getElementById('uses-authorization-name-text').value = text;
//   document.getElementById('uses-authorization-name-value').value = value;
// }

// function loadInputValuesPropertyDescription(usos, referencial) {
//   if (referencial != null) {
//     document.getElementById('uses-authorization-name-text').value = usos.Desc_Uso.trim();
//     document.getElementById('uses-authorization-name-value').value = usos.Cod_Uso;
//     document.getElementById('input-ref-uso').value = referencial;
//   } else {
//     document.getElementById('uses-authorization-name-text').value = usos.Desc_Uso.trim();
//     document.getElementById('uses-authorization-name-value').value = usos.Cod_Uso;
//   }
// }

// function onkeyupUsesAuthorizationName(event) {
//   let autocompleteText = event.target.value;

//   const itemsFiltered = usesAuthorizationNameValuesFromDatabase.filter((item) => {
//     return (
//       item['Desc_Uso'].includes(autocompleteText) || item['Cod_Uso'].includes(autocompleteText)
//     );
//   });

//   createUsesAuthorizationNameOptions(itemsFiltered);
// }

// function createUsesAuthorizationNameOptions(items) {
//   const usesAuthorizationNameValues = document.getElementById('uses-authorization-name-options');

//   usesAuthorizationNameValues.innerHTML = '';

//   for (const item of items) {
//     const li = `
//             <li class="a-autocomplete__item" onclick="onclickUsesAuthorizationNameItem('${item.Desc_Uso.trim()}', '${item.Cod_Uso}')">
//                 ${item.Cod_Uso} - ${item.Desc_Uso.trim()}
//             </li>
//         `;

//     usesAuthorizationNameValues.innerHTML += li;
//   }
// }

// function setUsesAuthorizationNameValuesFromDatabase(values) {
//   usesAuthorizationNameValuesFromDatabase = values;
// }
