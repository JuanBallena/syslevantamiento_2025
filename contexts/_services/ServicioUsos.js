class ServicioUsos extends BaseServicio {
  static obtenerUsosPorDescripcion(texto) {
    return this.request(window.ENDPOINTS.obtenerUsosPorDescripcion, { q: texto }, 'GET');
  }
}
