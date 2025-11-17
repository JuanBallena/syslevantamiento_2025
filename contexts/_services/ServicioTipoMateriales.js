class ServicioTipoMateriales extends BaseServicio {
  static obtenerTipoMateriales() {
    return this.request(window.ENDPOINTS.obtenerTipoMateriales);
  }
}
