class ServicioTipoEdificaciones extends BaseServicio {
  static obtenerTipoEdificaciones() {
    return this.request(window.ENDPOINTS.obtenerTipoEdificaciones);
  }
}
