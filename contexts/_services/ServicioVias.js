class ServicioVias extends BaseServicio {
  static obtenerVias() {
    return this.request(window.ENDPOINTS.obtenerVias);
  }
}
