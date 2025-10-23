class Helper {
  static generarId() {
    return crypto.randomUUID();
  }

  static generarOpciones(arr, valueKey = 'value', textKey = 'text', includeSelect = true) {
    let options = includeSelect ? `<option value="">Seleccione</option>` : '';
    arr.forEach((item) => {
      options += `<option value="${item[valueKey]}">${item[textKey]}</option>`;
    });
    return options;
  }

  static filtrarLista(texto, lista, campo) {
    if (!texto) return lista;
    return lista.filter((item) => {
      const valor = item[campo] ?? '';
      return valor.toLowerCase().includes(texto.toLowerCase());
    });
  }

  static mostrarSugerencias(
    input,
    lista,
    campoTexto,
    inputHidden,
    campoValue = 'id',
    inputReadonly = null,
    campoReadonly = 'id',
    campoTexto2 = null
  ) {
    const contenedor = input.parentElement.querySelector('.a-autocomplete__box');
    const ul = contenedor.querySelector('ul');
    ul.innerHTML = '';

    if (lista.length > 0) {
      lista.forEach((item) => {
        const li = document.createElement('li');
        li.className = 'py-1 px-4 hover:bg-success';
        li.dataset.value = item[campoValue];
        li.dataset.text =
          campoTexto2 !== null ? `${item[campoTexto]} - ${item[campoTexto2]}` : item[campoTexto];
        li.dataset.readonly = item[campoReadonly];
        li.dataset.item = JSON.stringify(item);

        li.textContent = li.dataset.text;
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

    ul.onclick = (e) => {
      if (e.target.tagName === 'LI' && e.target.dataset.disabled !== 'true') {
        input.value = e.target.dataset.text;
        inputHidden.value = e.target.dataset.value;
        contenedor.classList.add('none');

        if (inputReadonly) {
          inputReadonly.value = e.target.dataset.readonly;
        }
      }
    };
  }

  static llenarSelect(
    select,
    lista,
    itemValue = 'id',
    itemText = 'nombre',
    incluirSeleccione = true
  ) {
    // limpiar opciones previas
    select.innerHTML = '';

    // opción inicial
    if (incluirSeleccione) {
      const opt = document.createElement('option');
      opt.value = '';
      opt.textContent = 'Seleccione';
      select.appendChild(opt);
    }

    // recorrer lista y generar options
    if (Array.isArray(lista) && lista.length > 0) {
      lista.forEach((item) => {
        const option = document.createElement('option');
        option.value = item[itemValue];
        option.textContent = item[itemText];
        select.appendChild(option);
      });
    } else {
      // si no hay datos
      const opt = document.createElement('option');
      opt.value = '';
      opt.textContent = 'Sin resultados';
      opt.disabled = true;
      select.appendChild(opt);
    }
  }
}
