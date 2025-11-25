class ServicioUbigeos extends BaseServicio {
  static obtenerDepartamentos() {
    return this.request(window.ENDPOINTS.obtenerDepartamentos);
  }

  static obtenerProvinciasSegunCodiDep(codi_dep) {
    return this.request(
      window.ENDPOINTS.obtenerProvinciasSegunCodiDep,
      { codi_dep: codi_dep },
      'GET'
    );
  }

  static obtenerDistritosSegunCodiPro(codi_pro, codi_dep) {
    return this.request(
      window.ENDPOINTS.obtenerDistritosSegunCodiPro,
      { codi_pro: codi_pro, codi_dep: codi_dep },
      'GET'
    );
  }
}
