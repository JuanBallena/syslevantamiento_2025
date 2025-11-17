class SelectDinamico {
  constructor({ select, data = [], label, value, onSelect, defaultText = 'Seleccione' }) {
    this.select = select;
    this.data = data;
    this.label = label;
    this.value = value;
    this.onSelect = onSelect;
    this.defaultText = defaultText;

    this.render();
    this.bindEvents();
  }

  getLabel(item) {
    if (typeof this.label === 'function') return this.label(item) || '';
    return item?.[this.label] || '';
  }

  render() {
    this.select.innerHTML = '';

    // Opción inicial
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = this.defaultText;
    this.select.appendChild(defaultOption);

    // Opciones dinámicas
    this.data.forEach((item) => {
      const opt = document.createElement('option');
      opt.value = item[this.value] || '';
      opt.textContent = this.getLabel(item);
      this.select.appendChild(opt);
    });
  }

  bindEvents() {
    this.select.addEventListener('change', () => {
      if (this.onSelect) {
        const selectedValue = this.select.value;
        const selectedItem = this.data.find((item) => item[this.value] == selectedValue);
        this.onSelect(selectedItem || null);
      }
    });
  }

  setData(data) {
    this.data = data;
    this.render();
  }

  getValue() {
    return this.select.value;
  }

  setValue(val) {
    this.select.value = val;
    if (this.onSelect) {
      const selectedItem = this.data.find((item) => item[this.value] == val);
      this.onSelect(selectedItem || null);
    }
  }
}
