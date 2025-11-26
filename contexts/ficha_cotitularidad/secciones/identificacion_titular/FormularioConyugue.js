class FormularioConyugue {
  static async crear() {
    const placeholders = {};

    let html = await (
      await fetch('./../ficha_individual/secciones/identificacion_titular/FormularioConyugue.html')
    ).text();
    for (const [k, v] of Object.entries(placeholders)) html = html.replaceAll(k, v);

    return html;
  }
}
