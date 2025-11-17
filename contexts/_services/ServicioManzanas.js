class ServicioManzanas extends BaseServicio {
  static obtenerManzanas(id_sector) {
    return this.request(window.ENDPOINTS.obtenerManzanas, { id_sector: id_sector }, 'GET');
  }
}
