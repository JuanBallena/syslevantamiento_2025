class Helper {
  static generarId() {
    return crypto.randomUUID();
  }

  static generarOpciones(arr, includeSelect = true) {
    let options = includeSelect ? `<option value="">Seleccione</option>` : '';
    arr.forEach((item) => {
      options += `<option value="${item.value}">${item.text}</option>`;
    });
    return options;
  }
}
