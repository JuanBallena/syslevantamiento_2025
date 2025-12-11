class ControladorFichaUrbanaIndividual {
  constructor(formSelector) {
    this.form = document.querySelector(formSelector);

    this.form.addEventListener('submit', (e) => this.onSubmit(e));
  }

  onSubmit(e) {
    e.preventDefault();

    const valid = window.validadorGenerico.validateAll();

    if (!valid) {
      // this.showGlobalError();
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

    const response = await fetch('../../database/guardarInformacionCatastral.php', {
      method: 'POST',
      body: formData,
    });

    const text = await response.text();
    console.log('Respuesta cruda del servidor:');
    console.log(text);

    try {
      let result = JSON.parse(text);
      // console.log(result);

      if (result.success) {
        alert('La información se ha guardado correctamente.');
      }

      if (result.error) {
        alert('Error en el guardado.');
      }
    } catch (err) {
      alert('Error general al momento de guardar.');
    }
  }

  // obtenerMensajeErrorDuplicado(errorData) {
  //   if (!errorData || typeof errorData !== 'object') return null;

  //   const errorMsg = errorData.mensaje || '';

  //   const esDuplicado = errorMsg.includes('llave duplicada') || errorMsg.includes('duplicate key');

  //   if (!esDuplicado) return null;

  //   const campo = errorData.campo || 'campo desconocido';
  //   // const valor = errorData.valor || '';

  //   switch (campo) {
  //     case 'id_lote':
  //       alert(
  //         'Se generó un identificador existente para lote, ingresar un valor diferente para lote en la sección de datos generales.'
  //       );
  //       return;
  //     case 'id_uni_cat':
  //       alert(
  //         'Se generó un identificador existente para edifica, ingresar un valor diferente para edifica en la sección de datos generales.'
  //       );
  //     case 'dni':
  //       alert(
  //         'Se generó un identificador existente para declarante o persona, ingresar un valor diferente para el dni del declarante.'
  //       );
  //       return;
  //     case 'id_ficha':
  //       alert('Se generó un identificador existente para la ficha, c');
  //       return;
  //     default:
  //       alert('Se generó un identificador existente al momento de guardar la información.');
  //   }
  // }
}

document.addEventListener('DOMContentLoaded', () => {
  new ControladorFichaUrbanaIndividual('#formulario-ficha-urbana-individual');
});
