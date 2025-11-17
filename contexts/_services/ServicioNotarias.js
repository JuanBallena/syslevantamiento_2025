class ServicioNotarias extends BaseServicio {
  static obtenerNotarias() {
    return this.request(window.ENDPOINTS.obtenerNotarias);
  }
}
