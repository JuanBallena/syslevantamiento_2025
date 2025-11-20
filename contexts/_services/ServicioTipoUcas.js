class ServicioTipoUcas extends BaseServicio {
  static obtenerTipoUcas() {
    return this.request(window.ENDPOINTS.obtenerTipoUcas);
  }
}
