class ServicioFicha extends BaseServicio {
  static obtenerFichaPorNumero(numeFicha) {
    return this.request(window.ENDPOINTS.obtenerFichaPorNumero, { nume_ficha: numeFicha });
  }

  static obtenerFichaPorNumeroYPorId(numeFicha, idFicha) {
    console.log('ficha y id');
    return this.request(window.ENDPOINTS.obtenerFichaPorNumeroYPorId, {
      nume_ficha: numeFicha,
      id_ficha: idFicha,
    });
  }
}
