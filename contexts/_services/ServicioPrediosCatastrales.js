class ServicioPrediosCatastrales extends BaseServicio {
  static obtenerPrediosCatastrales() {
    return this.request(window.ENDPOINTS.obtenerPrediosCatastrales);
  }
}
