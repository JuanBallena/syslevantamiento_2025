class ServicioTiposEcs extends BaseServicio {
  static obtenerTiposEcs() {
    return this.request(window.ENDPOINTS.obtenerTiposEcs);
  }
}
