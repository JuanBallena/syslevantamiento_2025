class FormularioPersonaNatural {
  static estadosCiviles = [
    { value: '01', text: 'Soltero(a)' },
    { value: '02', text: 'Casado(a)' },
    { value: '03', text: 'Divorciado(a)' },
    { value: '04', text: 'Viudo(a)' },
    { value: '05', text: 'Conviviente' },
  ];

  static tipoDocumentos = [
    { value: '01', text: 'No presentó documento' },
    { value: '02', text: 'DNI' },
    { value: '03', text: 'Carnet Policía' },
    { value: '04', text: 'Carnet Fuerzas Armadas' },
    { value: '05', text: 'Partida de Nacimiento' },
    { value: '06', text: 'Pasaporte' },
    { value: '07', text: 'Carnet de Extranjería' },
    { value: '08', text: 'Otros' },
  ];

  static async crear() {
    const placeholders = {};

    let html = await (
      await fetch(
        './../ficha_individual/secciones/identificacion_titular/FormularioPersonaNatural.html'
      )
    ).text();
    for (const [k, v] of Object.entries(placeholders)) html = html.replaceAll(k, v);

    return html;
  }
}
