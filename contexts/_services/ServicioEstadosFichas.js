class ServicioEstadosFichas extends BaseServicio {
  static async obtenerEstadosFichas() {
    return this.request(window.ENDPOINTS.obtenerEstadosFichas);
  }
}
