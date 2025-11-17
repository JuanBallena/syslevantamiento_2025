class ServicioCodigosInstalaciones extends BaseServicio {
  static obtenerCodigosInstalaciones() {
    return this.request(window.ENDPOINTS.obtenerCodigosInstalaciones);
  }
}
