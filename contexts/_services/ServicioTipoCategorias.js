class ServicioTipoCategorias extends BaseServicio {
  static obtenerTipoCategorias() {
    return this.request(window.ENDPOINTS.obtenerTipoCategorias);
  }
}
