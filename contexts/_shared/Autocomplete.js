class Autocomplete {
  constructor({ input, data, label, value, onSelect }) {
    this.input = input;
    this.data = data;
    this.label = label;
    this.value = value;
    this.onSelect = onSelect;

    this.box = this.createBox();
    this.bindEvents();
  }

  createBox() {
    const box = document.createElement('section');
    box.className = 'a-autocomplete__box none';
    box.innerHTML = `<ul class="a-autocomplete__items"></ul>`;
    this.input.parentElement.appendChild(box);
    return box;
  }

  createLi(texto, item) {
    const li = document.createElement('li');
    li.className = 'py-1 px-4 hover:bg-success';
    li.textContent = texto;
    li.dataset.item = JSON.stringify(item);
    return li;
  }

  show() {
    const ul = this.box.querySelector('ul');
    ul.innerHTML = '';

    const texto = this.input.value.toLowerCase();

    const filtrados = this.data.filter((item) => item[this.label].toLowerCase().includes(texto));

    if (!filtrados.length) {
      ul.appendChild(this.createLi('Sin opciones', { disabled: true }));
      this.box.classList.remove('none');
      return;
    }

    filtrados.forEach((item) => {
      const textoItem = typeof this.label === 'function' ? this.label(item) : item[this.label];

      ul.appendChild(this.createLi(textoItem, item));
    });

    this.box.classList.remove('none');
  }

  hide() {
    this.box.classList.add('none');
  }

  bindEvents() {
    this.input.addEventListener('keyup', () => this.show());
    this.input.addEventListener('click', () => this.show());
    this.input.addEventListener('blur', () => setTimeout(() => this.hide(), 200));

    this.box.addEventListener('click', (e) => {
      if (e.target.tagName === 'LI') {
        const item = JSON.parse(e.target.dataset.item);
        this.input.value = item[this.label].trim();

        if (this.onSelect) {
          this.onSelect(item);
        }

        this.hide();
      }
    });
  }
}

// class Autocompletado {
//   static crearLiSinOpciones() {
//     const li = document.createElement('li');
//     li.className = 'py-1 px-4';
//     li.dataset.disabled = 'true';
//     li.textContent = 'Sin opciones';

//     return li;
//   }

//   static crearLi(texto = '', item = null) {
//     const li = document.createElement('li');
//     li.className = 'py-1 px-4 hover:bg-success';
//     li.dataset.item = JSON.stringify(item);
//     li.textContent = texto;

//     return li;
//   }

//   static cerrar(input) {
//     const contenedor = input.parentElement.querySelector('section');
//     setTimeout(() => contenedor.classList.add('none'), 150);
//   }
// }
