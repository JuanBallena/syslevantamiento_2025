class ServicioTipoInteriores extends BaseServicio {
  static obtenerTipoInteriores() {
    return this.request(window.ENDPOINTS.obtenerTipoInteriores);
  }
}
