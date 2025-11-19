class ServicioDeclarantes extends BaseServicio {
  static obtenerDeclarantesPorDni(dni) {
    return this.request(window.ENDPOINTS.obtenerDeclarantesPorDni, { q: dni }, 'GET');
  }
}
