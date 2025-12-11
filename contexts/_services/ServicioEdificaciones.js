class ServicioEdificaciones extends BaseServicio {
  static obtenerEdificacionPorId(id_edificacion) {
    return this.request(window.ENDPOINTS.obtenerEdificacionPorId, {
      id_edificacion: id_edificacion,
    });
  }
}
