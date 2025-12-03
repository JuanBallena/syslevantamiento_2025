class IdentificacionTitular {
  constructor() {
    this.contenedorNaturales = document.getElementById('contenedor-personas-naturales');
    this.contenedorJuridicas = document.getElementById('contenedor-personas-juridicas');

    this.initEventosGlobales();
  }

  async cargarFormularioTitular() {
    const tipoPersona = document.querySelector(
      "#identificacion-titular select[name='tipo_persona']"
    ).value;

    this.contenedorNaturales.innerHTML = '';
    this.contenedorJuridicas.innerHTML = '';

    if (tipoPersona === '1') {
      const html = await FormularioPersonaNatural.crear();
      this.contenedorNaturales.insertAdjacentHTML('beforeend', html);

      let contenedorPersonaNatural = document.querySelector("[data-tipo='natural']");

      this.initSelectEstadoCivil(contenedorPersonaNatural);
      this.initSelectTipoDocumento(contenedorPersonaNatural);
    }

    if (tipoPersona === '2') {
      const html = await FormularioPersonaJuridica.crear();
      this.contenedorJuridicas.insertAdjacentHTML('beforeend', html);

      let contenedorPersonaJuridica = document.querySelector("[data-tipo='juridica']");

      this.initSelectTipoPersonaJuridica(contenedorPersonaJuridica);
    }

    this.activarEventosLocales();
  }

  initSelectEstadoCivil(contenedor) {
    const selectEstadoCivil = contenedor.querySelector('[name="esta_civil"]');

    new SelectDinamico({
      select: selectEstadoCivil,
      data: FormularioPersonaNatural.estadosCiviles,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  initSelectTipoDocumento(contenedor) {
    // console.log(contenedor);
    const selectTipoDocumento = contenedor.querySelector('[name="tipo_doc"]');
    // console.log(selectTipoDocumento);

    new SelectDinamico({
      select: selectTipoDocumento,
      data: FormularioPersonaNatural.tipoDocumentos,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  initSelectTipoPersonaJuridica(contenedor) {
    const selectTipoPersonaJuridica = contenedor.querySelector('[name="tipo_persona_juridica"]');

    new SelectDinamico({
      select: selectTipoPersonaJuridica,
      data: FormularioPersonaJuridica.tipos,
      label: (item) => item.text,
      value: 'value',
      defaultText: 'Seleccione',
      onSelect: (item) => {
        //
      },
    });
  }

  initEventosGlobales() {
    document.addEventListener('change', (e) => {
      if (e.target.name === 'tipo_persona') {
        this.cargarFormularioTitular();
      }
    });
  }

  activarEventosLocales() {
    const contenedorPersonaNatural = document.querySelector('[data-tipo="natural"]');

    if (contenedorPersonaNatural) {
      contenedorPersonaNatural.addEventListener('change', (e) => {
        if (e.target.name === 'esta_civil') {
          this.manejarEstadoCivil(e.target);
        }
      });
    }
  }

  async manejarEstadoCivil(select) {
    const valor = select.value;
    const contenedorPersonaNatural = select.closest("[data-tipo='natural']");
    let contenedorConyugue = document.querySelector("[data-tipo='conyugue']");

    if (valor === '02') {
      if (!contenedorConyugue) {
        const htmlConyugue = await FormularioConyugue.crear();
        contenedorPersonaNatural.insertAdjacentHTML('afterend', htmlConyugue);

        contenedorConyugue = document.querySelector("[data-tipo='conyugue']");

        this.initSelectTipoDocumento(contenedorConyugue);
      }
    } else {
      if (contenedorConyugue) contenedorConyugue.remove();
      return;
    }
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return {
      tipo_persona: document.querySelector('[name="tipo_persona"]').value,
      personaNatural: formDataExtractor.obtenerDatosDesdeDataset(
        'identificacion-titular',
        '[data-tipo="natural"]'
      ),
      personaJuridica: formDataExtractor.obtenerDatosDesdeDataset(
        'identificacion-titular',
        '[data-tipo="juridica"]'
      ),
      conyugue: formDataExtractor.obtenerDatosDesdeDataset(
        'identificacion-titular',
        '[data-tipo="conyugue"]'
      ),
    };
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.identificacionTitular = new IdentificacionTitular();
});
