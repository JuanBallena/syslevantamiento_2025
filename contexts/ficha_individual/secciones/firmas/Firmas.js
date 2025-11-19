class Firmas {
  constructor() {
    this.inputsDniPersona = document.querySelectorAll('.dni-persona');

    this.initAutocompleteDeclarante();
    this.initAutocompletePersonas();
  }

  initAutocompleteDeclarante() {
    // this.inputDeclarante.forEach((input) => {
    const section = document.getElementById('datos-declarante');
    const inputDeclarante = section.querySelector('[name="dni"]');
    const checkbox = section.querySelector('input[name="existe_declarante"]');

    const autocomplete = new Autocomplete({
      input: inputDeclarante,
      inputHidden: null,
      data: [],
      label: (item) => item.dni,
      value: 'dni',
      onSelect: (item) => {
        section.querySelector('[name="nombres"]').value = item.nombres;
        section.querySelector('[name="ape_materno"]').value = item.ape_materno;
        section.querySelector('[name="ape_paterno"]').value = item.ape_paterno;

        checkbox.checked = true;
      },
    });

    inputDeclarante.addEventListener('input', async (e) => {
      const dni = e.target.value.trim();
      checkbox.checked = false;

      if (dni.length !== 8) {
        section.querySelector('[name="nombres"]').value = '';
        section.querySelector('[name="ape_materno"]').value = '';
        section.querySelector('[name="ape_paterno"]').value = '';
        autocomplete.updateData([]);
        return;
      }

      const res = await ServicioDeclarantes.obtenerDeclarantesPorDni(dni);

      if (res.success && Array.isArray(res.data)) {
        autocomplete.updateData(res.data);
      } else {
        autocomplete.updateData([]);
      }
    });
    // });
  }

  initAutocompletePersonas() {
    this.inputsDniPersona.forEach((input) => {
      const inputHidden = input.parentElement.querySelector('input[type="hidden"]') ?? null;
      const section = document.getElementById(input.dataset.section);

      let autocomplete = new Autocomplete({
        input,
        inputHidden,
        data: [],
        label: (item) => `${item.nombres} ${item.ape_paterno} ${item.ape_materno}`,
        value: 'nume_doc',
        onSelect: (item) => {
          section.querySelector('[name="nombres"]').value = item.nombres;
          section.querySelector('[name="ape_materno"]').value = item.ape_materno;
          section.querySelector('[name="ape_paterno"]').value = item.ape_paterno;
        },
      });

      input.addEventListener('input', async (e) => {
        const texto = e.target.value.trim();

        if (texto.length < 2) {
          autocomplete.updateData([]);
          section.querySelector('[name="nombres"]').value = '';
          section.querySelector('[name="ape_materno"]').value = '';
          section.querySelector('[name="ape_paterno"]').value = '';
          return;
        }

        const res = await ServicioPersonas.obtenerPersonasPorNombresApellidos(texto);

        if (res.success && Array.isArray(res.data)) {
          autocomplete.updateData(res.data);
        } else {
          autocomplete.updateData([]);
        }
      });
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return {
      declarante: formDataExtractor.obtenerDatosDesdeContenedor('datos-declarante'),
      supervisor: formDataExtractor.obtenerDatosDesdeContenedor('datos-supervisor'),
      tecnico: formDataExtractor.obtenerDatosDesdeContenedor('datos-tecnico'),
      verificador: formDataExtractor.obtenerDatosDesdeContenedor('datos-verificador'),
    };
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.firmas = new Firmas();
});
