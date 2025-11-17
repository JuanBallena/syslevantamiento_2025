class ServicioSectores extends BaseServicio {
  static obtenerSectores() {
    return this.request(window.ENDPOINTS.obtenerSectores);
  }
}
