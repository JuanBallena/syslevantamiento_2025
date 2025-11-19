class ServicioMantenimientos extends BaseServicio {
  static obtenerMantenimientos() {
    return this.request(window.ENDPOINTS.obtenerMantenimientos);
  }
}
