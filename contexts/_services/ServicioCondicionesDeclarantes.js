class ServicioCondicionesDeclarantes extends BaseServicio {
  static async obtenerCondicionesDeclarantes() {
    return this.request(window.ENDPOINTS.obtenerCondicionesDeclarantes);
  }
}
