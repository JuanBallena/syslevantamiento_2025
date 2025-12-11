class ServicioLotes extends BaseServicio {
  static obtenerLotePorId(id_lote) {
    console.log(id_lote);
    return this.request(window.ENDPOINTS.obtenerLotePorId, { id_lote: id_lote });
  }
}
