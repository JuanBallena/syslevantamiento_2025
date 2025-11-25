class DomicilioTitular {
  constructor() {
    this.selectCodiDep = document.querySelector('select[name="codi_dep"]');
    this.selectCodiPro = document.querySelector('select[name="codi_pro"]');
    this.selectCodiDis = document.querySelector('select[name="codi_dis"]');

    this.departamentos = [];
    this.provincias = [];
    this.distritos = [];

    // this.selectDinamicoDistritos = null;

    this.codiDep = null;

    this.init();
  }

  async init() {
    this.initSelectCodiDep();
  }

  async initSelectCodiDep() {
    try {
      const res = await ServicioUbigeos.obtenerDepartamentos();

      console.log(res);

      if (res && res.success && Array.isArray(res.data)) {
        this.departamentos = res.data;
      } else {
        console.warn('ServicioUbigeos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener ubigeos:', err);
    }

    new SelectDinamico({
      select: this.selectCodiDep,
      data: this.departamentos,
      label: (item) => item.descri,
      value: 'codi_dep',
      defaultText: 'Seleccione',
      onSelect: async (item) => {
        await this.initSelectCodiProSegunCodiDep(item.codi_dep);

        this.distritos = [];
      },
    });
  }

  async initSelectCodiProSegunCodiDep(codi_dep) {
    try {
      console.log(codi_dep);

      this.codiDep = codi_dep;
      const res = await ServicioUbigeos.obtenerProvinciasSegunCodiDep(codi_dep);

      if (res && res.success && Array.isArray(res.data)) {
        this.provincias = res.data;
      } else {
        console.warn('ServicioUbigeos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener ubigeos:', err);
    }

    new SelectDinamico({
      select: this.selectCodiPro,
      data: this.provincias,
      label: (item) => item.descri,
      value: 'codi_pro',
      defaultText: 'Seleccione',
      onSelect: async (item) => {
        await this.initSelectCodiDisSegunCodiPro(item.codi_pro);
      },
    });
  }
  async initSelectCodiDisSegunCodiPro(codi_pro) {
    try {
      const res = await ServicioUbigeos.obtenerDistritosSegunCodiPro(codi_pro, this.codiDep);

      if (res && res.success && Array.isArray(res.data)) {
        this.distritos = res.data;
      } else {
        console.warn('ServicioUbigeos: respuesta inválida', res);
      }
    } catch (err) {
      console.error('Error al obtener ubigeos:', err);
    }

    new SelectDinamico({
      select: this.selectCodiDis,
      data: this.distritos,
      label: (item) => item.descri,
      value: 'codi_dis',
      defaultText: 'Seleccione',
    });
  }

  getData() {
    const formDataExtractor = new FormDataExtractor();

    return formDataExtractor.obtenerDatosDesdeContenedor('domicilio-titular');
  }
}
document.addEventListener('DOMContentLoaded', async () => {
  window.domicilioTitular = new DomicilioTitular();
});
