class ControladorFichaUrbanaIndividual {
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);
    // this.validator = new ValidatorGenerico();

    this.form.addEventListener('submit', (e) => this.onSubmit(e));
  }

  onSubmit(e) {
    e.preventDefault();

    const valid = window.validadorGenerico.validateAll();

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

  async enviarFormulario() {
    console.log('Formulario validado y listo para enviar...');

    const dataPost = {
      cabecera: window.cabecera.getData(),
      datosGenerales: window.datosGenerales.getData(),
      ubicacionPredio: window.ubicacionPredio.getData(),
      identificacionTitular: window.identificacionTitular.getData(),
      domicilioTitular: window.domicilioTitular.getData(),
      caracteristicasTitularidad: window.caracteristicasTitularidad.getData(),
      descripcionPredio: window.descripcionPredio.getData(),
      serviciosBasicos: window.serviciosBasicos.getData(),
      construcciones: window.construcciones.getData(),
      obrasComplementarias: window.obrasComplementarias.getData(),
      documentos: window.documentos.getData(),
      inscripcionPredio: window.inscripcionPredio.getData(),
      evaluacionPredio: window.evaluacionPredio.getData(),
      informacionComplementaria: window.informacionComplementaria.getData(),
      observaciones: window.observaciones.getData(),
      firmas: window.firmas.getData(),
    };

    console.log(dataPost);

    const formData = new FormData();
    formData.append('dataPost', JSON.stringify(dataPost));

    // const files = obtenerImagenesAdjuntas();
    // for (const file of files) {
    //   formData.append('archivos[]', file);
    // }

    try {
      const response = await fetch('../../database/guardarInformacionCatastral.php', {
        method: 'POST',
        body: formData,
      });

      // ✅ Leer la respuesta como texto primero
      const text = await response.text();
      console.log(text);

      console.log(JSON.parse(text));

      // console.log('📄 Respuesta cruda del servidor:', JSON.parse(text));

      // let result;
      // try {
      //   result = JSON.parse(text);
      // } catch (e) {
      //   // console.error(
      //   //   '⚠️ La respuesta no es JSON válido. Revisa el texto anterior (probablemente un error de PHP).'
      //   // );
      //   return;
      // }

      if (result.success) {
        console.log('Éxito:');
        console.log(result);
      } else {
        // mostrarErrores(text);
        console.log('Error del servidor:');
        console.log(result.error);
      }
    } catch (err) {
      console.log('Error de red o fetch:', err);
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new ControladorFichaUrbanaIndividual('#formulario-ficha-urbana-individual');
});
