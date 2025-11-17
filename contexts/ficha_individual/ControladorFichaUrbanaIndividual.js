class ControladorFichaUrbanaIndividual {
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);
    this.validator = new ValidatorGenerico();

    this.form.addEventListener('submit', (e) => this.onSubmit(e));
  }

  onSubmit(e) {
    const valid = this.validator.validateAll();

    if (!valid) {
      e.preventDefault();
      this.showGlobalError();
      this.scrollToFirstError();
      return;
    }

    this.enviarFormulario();
  }

  showGlobalError() {
    let error = document.querySelector('#global-error');

    if (!error) {
      error = document.createElement('div');
      error.id = 'global-error';
      error.style.color = 'red';
      error.style.marginBottom = '10px';
      error.style.fontWeight = 'bold';

      this.form.prepend(error);
    }

    error.textContent = 'Hay errores en el formulario. Revise los campos marcados.';
  }

  scrollToFirstError() {
    const firstError = this.form.querySelector('.error-msg');
    if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  enviarFormulario() {
    console.log('Formulario validado y listo para enviar...');
    // aquí haces fetch(), axios(), submit normal, etc
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new ControladorFichaUrbanaIndividual('#formulario-ficha-urbana-individual');
});
