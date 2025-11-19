class ServicioPersonas extends BaseServicio {
  static obtenerPersonasPorNombresApellidos(texto) {
    return this.request(window.ENDPOINTS.obtenerPersonasPorNombresApellidos, { q: texto }, 'GET');
  }
}
