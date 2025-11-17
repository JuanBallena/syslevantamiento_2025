class ServicioClasificacionesPredios extends BaseServicio {
  static obtenerClasificacionesPredios() {
    return this.request(window.ENDPOINTS.obtenerClasificacionesPredios);
  }
}
