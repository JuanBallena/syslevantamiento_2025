class ValidatorGenerico {
  constructor() {
    this.rules = {
      required: (value) => value !== null && value !== undefined && value.trim().length > 0,
      numeric: (value) => /^[0-9]+$/.test(value),
      text: (value) => /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/.test(value),
      min: (value, n) => value.length >= Number(n),
      max: (value, n) => value.length <= Number(n),

      // Relleno con ceros solo al blur
      pad: (value, n, input, eventType) => {
        if (eventType === 'blur' && value !== '') {
          input.value = value.padStart(Number(n), '0');
        }
        return true; // siempre retorna true, no es un error
      },
    };

    this.messages = {
      required: 'Campo obligatorio',
      numeric: 'Solo se permiten números',
      text: 'Solo se permiten letras',
      min: (n) => `Debe tener al menos ${n} caracteres`,
      max: (n) => `Debe tener máximo ${n} caracteres`,
      pad: () => '',
    };

    this.init();

    // console.log('Init validador genérico');
  }

  init() {
    this.inputs = document.querySelectorAll('[data-validate]');

    this.inputs.forEach((input) => {
      input.addEventListener('input', (e) => this.validate(input, e.type));
      input.addEventListener('change', (e) => this.validate(input, e.type)); // aqui
      input.addEventListener('blur', (e) => this.validate(input, e.type));
    });
  }

  validate(input, eventType = 'input') {
    let raw = input.value;

    // Si es select NO usar trim (los valores pueden ser numericos, texto corto, etc.)
    let value = input.tagName === 'SELECT' ? String(raw ?? '') : String(raw ?? '').trim();
    const rules = input.dataset.validate ? input.dataset.validate.split('|') : [];

    // Primero required
    if (rules.includes('required') && !this.rules.required(value)) {
      this.showError(input, this.messages.required);
      return false;
    }

    if (!rules.includes('required') && value === '') {
      this.clearError(input);
      return true;
    }

    for (let rule of rules) {
      let [name, param] = rule.split(':');
      if (name === 'required') continue;

      const fn = this.rules[name];
      if (!fn) continue;

      const ok = fn(value, param, input, eventType);
      if (!ok) {
        this.showError(input, this.buildMessage(name, param));
        return false;
      }
    }

    this.clearError(input);
    return true;
  }

  buildMessage(name, param) {
    const msg = this.messages[name];
    return typeof msg === 'function' ? msg(param) : msg;
  }

  showError(input, message) {
    let msgEl = input.parentNode.querySelector('.error-msg');
    if (!msgEl) {
      msgEl = document.createElement('div');
      msgEl.classList.add('error-msg');
      msgEl.style.color = 'red';
      msgEl.style.fontWeight = 'bold';
      msgEl.style.fontSize = '14px';
      msgEl.style.marginTop = '4px';

      input.parentNode.appendChild(msgEl);
    }
    msgEl.textContent = message;
    input.classList.add('input-error');
  }

  clearError(input) {
    const msgEl = input.parentNode.querySelector('.error-msg');
    if (msgEl) msgEl.textContent = '';
    input.classList.remove('input-error');
  }

  validateAll() {
    let allValid = true;
    this.inputs.forEach((input) => {
      const ok = this.validate(input, 'blur'); // usar 'blur' para que ejecute pad si es necesario
      if (!ok) allValid = false;
    });
    return allValid;
  }

  registerInputs(container) {
    const nuevos = container.querySelectorAll('[data-validate]');

    nuevos.forEach((input) => {
      // Evitar registrar duplicados
      if (![...this.inputs].includes(input)) {
        this.inputs = [...this.inputs, input];

        // Registrar eventos
        input.addEventListener('input', (e) => this.validate(input, e.type));
        input.addEventListener('blur', (e) => this.validate(input, e.type));
        input.addEventListener('change', (e) => this.validate(input, e.type));
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.validadorGenerico = new ValidatorGenerico();
});
