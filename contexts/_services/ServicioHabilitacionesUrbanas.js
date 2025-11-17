class ServicioHabilitacionesUrbanas extends BaseServicio {
  static obtenerHabilitacionesUrbanas() {
    return this.request(window.ENDPOINTS.obtenerHabilitacionesUrbanas);
  }
}
