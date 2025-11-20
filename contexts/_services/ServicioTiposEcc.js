class ServicioTiposEcc extends BaseServicio {
  static obtenerTiposEcc() {
    return this.request(window.ENDPOINTS.obtenerTiposEcc);
  }
}
