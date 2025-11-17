class ServicioFicha extends BaseServicio {
  static buscarPorNumero(numeFicha) {
    return this.request(window.ENDPOINTS.fichaPorNumero, { nume_ficha: numeFicha });
  }
}
