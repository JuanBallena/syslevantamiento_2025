class FormularioPersonaJuridica {
  static tipos = [
    { value: '01', text: 'Empresa' },
    { value: '02', text: 'Cooperativa' },
    { value: '03', text: 'Asociación' },
    { value: '04', text: 'Fundación' },
    { value: '05', text: 'Otros' },
  ];

  static async crear() {
    const placeholders = {};

    let html = await (
      await fetch(
        './../ficha_individual/secciones/identificacion_titular/FormularioPersonaJuridica.html'
      )
    ).text();
    for (const [k, v] of Object.entries(placeholders)) html = html.replaceAll(k, v);

    return html;
  }
}
