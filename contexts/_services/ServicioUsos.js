class ServicioUsos extends BaseServicio {
  static obtenerUsosPorDescripcion(texto) {
    return this.request(window.ENDPOINTS.obtenerUsosPorDescripcion, { q: texto }, 'GET');
  }

  static obtenerUsosPorCodigo(codi_uso) {
    return this.request(window.ENDPOINTS.obtenerUsosPorCodigo, { codi_uso: codi_uso }, 'GET');
  }
}
