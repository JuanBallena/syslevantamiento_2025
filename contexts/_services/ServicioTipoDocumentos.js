class ServicioTipoDocumentos extends BaseServicio {
  static obtenerTipoDocumentos() {
    return this.request(window.ENDPOINTS.obtenerTipoDocumentos);
  }
}
