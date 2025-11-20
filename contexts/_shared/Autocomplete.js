class Autocomplete {
  constructor({ input, inputHidden, data, label, value, onSelect, onInput, required = true }) {
    this.input = input; // input visible
    this.hiddenInput = inputHidden;
    this.data = data;
    this.label = label; // string o función
    this.value = value; // propiedad para hidden
    this.onSelect = onSelect;
    this.onInput = onInput;
    this.required = required;

    this.box = this.createBox();
    this.list = this.box.querySelector('ul');

    this.mouseDownOnList = false; // 🔹 flag para click en la lista

    this.bindEvents();
  }

  updateData(newData) {
    this.data = newData;
  }

  createBox() {
    const wrapper = document.createElement('div');
    wrapper.className = 'a-autocomplete';

    // Insertar wrapper antes del input
    this.input.parentNode.insertBefore(wrapper, this.input);

    // Mover input dentro del wrapper
    wrapper.appendChild(this.input);

    // Crear caja de opciones
    const box = document.createElement('div');
    box.className = 'a-autocomplete__box none';

    const ul = document.createElement('ul');
    ul.className = 'a-autocomplete__items cursor-pointer';
    box.appendChild(ul);

    // 🚨 IMPORTANTE: insertar box antes del mensaje de error
    wrapper.appendChild(box);

    return box;
  }

  getLabel(item) {
    return typeof this.label === 'function' ? this.label(item) || '' : item?.[this.label] || '';
  }

  createLi(texto, item) {
    const li = document.createElement('li');
    li.className = 'py-1 px-4 hover:bg-success';
    li.textContent = texto;
    if (item) li.dataset.item = JSON.stringify(item);
    else li.dataset.disabled = 'true';
    return li;
  }

  show() {
    const texto = this.input.value.toLowerCase().trim();
    this.list.innerHTML = '';

    let filtrados = [];

    // Si hay texto → filtrar
    if (texto) {
      filtrados = this.data.filter((item) => this.getLabel(item).toLowerCase().includes(texto));
    } else {
      // Si NO hay texto pero existe data → mostrar toda la lista
      filtrados = [...this.data];
    }

    // Si no hay opciones
    if (!filtrados.length) {
      this.list.appendChild(this.createLi('Sin opciones', null));
      this.box.classList.remove('none');
      return;
    }

    // Mostrar opciones
    filtrados.forEach((item) => {
      this.list.appendChild(this.createLi(this.getLabel(item), item));
    });

    this.box.classList.remove('none');
  }

  hide() {
    this.box.classList.add('none');
  }

  showError(message) {
    let msgEl = this.box.nextElementSibling;

    if (!msgEl || !msgEl.classList.contains('error-msg')) {
      msgEl = document.createElement('div');
      msgEl.classList.add('error-msg');
      msgEl.style.color = 'tomato';
      msgEl.style.fontSize = '14px';
      msgEl.style.marginTop = '4px';

      // Insertar el error DESPUÉS de la caja del autocomplete
      this.box.insertAdjacentElement('afterend', msgEl);
    }

    msgEl.textContent = message;
    this.input.classList.add('input-error');
  }

  clearError() {
    let msgEl = this.box.nextElementSibling;

    if (msgEl && msgEl.classList.contains('error-msg')) {
      msgEl.textContent = '';
    }

    this.input.classList.remove('input-error');
  }

  bindEvents() {
    // 🔹 limpiar hidden y borrar error al escribir
    this.input.addEventListener('input', () => {
      const texto = this.input.value.trim().toLowerCase();

      // Si el texto NO coincide con ningún item seleccionado → limpiar hidden
      const coincide = this.data.some((item) => this.getLabel(item).toLowerCase() === texto);

      if (!coincide && this.hiddenInput) {
        this.hiddenInput.value = '';
      }

      if (typeof this.onInput === 'function') {
        this.onInput();
      }

      this.clearError();
      this.show();
    });

    // 🔹 click en la lista
    this.list.addEventListener('mousedown', () => {
      this.mouseDownOnList = true;
    });
    this.list.addEventListener('mouseup', () => {
      this.mouseDownOnList = false;
    });

    this.list.addEventListener('click', (e) => {
      const li = e.target.closest('li');
      if (!li || !li.dataset.item) return;

      const item = JSON.parse(li.dataset.item);

      this.input.value = this.getLabel(item).trim();

      if (this.hiddenInput && this.value) this.hiddenInput.value = item[this.value] || '';

      if (this.onSelect) this.onSelect(item);

      this.clearError();
      this.hide();
    });

    // 🔹 blur del input-text
    this.input.addEventListener('blur', () => {
      setTimeout(() => {
        if (!this.mouseDownOnList) {
          if (this.required && this.hiddenInput && !this.hiddenInput.value) {
            this.showError('Debe seleccionar una opción de la lista');
          } else {
            this.clearError();
          }
          this.hide();
        }
      }, 100);
    });

    this.input.addEventListener('click', () => this.show());
    // this.input.addEventListener('keyup', () => this.show());
  }
}
