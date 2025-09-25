document.getElementById('form-ficha-individual').addEventListener('submit', (event) => {
  event.preventDefault();

  const ubigeo = document.getElementById('ubigeo');
  const codigoReferenciaCatastral = document.getElementById('codigo-referencia-catastral');
  const ubicacionPredioCatastral = document.getElementById('ubicacion-predio-catastral');

  const personasNaturales = obtenerPersonas('contenedor-personas-naturales', 'natural');
  const personasJuridicas = obtenerPersonas('contenedor-personas-juridicas', 'juridica');
  const vias = obtenerVias();

  const observaciones = document.getElementById('observaciones');

  let dataPost = {
    ubigeo: {
      departamento: ubigeo.querySelector('[name="departamento"]').value,
      provincia: ubigeo.querySelector('[name="provincia"]').value,
      distrito: ubigeo.querySelector('[name="distrito"]').value,
    },
    codigoReferenciaCatastral: {
      sector: codigoReferenciaCatastral.querySelector('[name="sector"]').value,
      manzana: codigoReferenciaCatastral.querySelector('[name="manzana"]').value,
      lote: codigoReferenciaCatastral.querySelector('[name="lote"]').value,
      edifica: codigoReferenciaCatastral.querySelector('[name="edifica"]').value,
      entrada: codigoReferenciaCatastral.querySelector('[name="entrada"]').value,
      piso: codigoReferenciaCatastral.querySelector('[name="piso"]').value,
      unidad: codigoReferenciaCatastral.querySelector('[name="unidad"]').value,
    },
    ubicaccionPredioCatastral: {
      estadoUnidad: ubicacionPredioCatastral.querySelector('[name="estado-unidad"]').value,
      habilitacionUrbana: ubicacionPredioCatastral.querySelector('[name="habilitacion-urbana"]')
        .value,
      grupoHU: ubicacionPredioCatastral.querySelector('[name="grupo-HU"]').value,
      nroEtapa: ubicacionPredioCatastral.querySelector('[name="nro-etapa"]').value,
      manzana: ubicacionPredioCatastral.querySelector('[name="manzana"]').value,
      lote: ubicacionPredioCatastral.querySelector('[name="lote"]').value,
      subLote: ubicacionPredioCatastral.querySelector('[name="sub-lote"]').value,
    },
    identificacionTitularCatastral: {
      personasNaturales: personasNaturales,
      personasJuridicas: personasJuridicas,
    },
    puertasPredioCatastral: vias,
    DescripcionPredio: {
      //
    },
    ServiciosBasicos: {
      //
    },
    construcciones: {
      //
    },
    informacionComplementaria: {
      //
    },
    imagenesAdjuntas: {
      //
    },
    observaciones: {
      text: observaciones.querySelector('[name="text"]').value,
    },
    datosTecnicoCatastral: {
      //
    },
  };

  console.log(dataPost);
});

function obtenerPersonas(idContenedor, tipo) {
  const contenedor = document.getElementById(idContenedor);
  let personas = [];

  contenedor.querySelectorAll('.m-form-section').forEach((section) => {
    const id = section.dataset.id;

    if (tipo === 'natural') {
      personas.push({
        id,
        tipo,
        estadoCivil: section.querySelector('[name="estado-civil"]').value,
        tipoDocumento: section.querySelector('[name="tipo-documento"]').value,
        numeroDocumento: section.querySelector('.input-num-doc').value,
        sinDocumento: section.querySelector('[name="sin-documento"]').checked,
        nombres: section.querySelector('[name="nombres"]').value,
        apellidoPaterno: section.querySelector('[name="apellido-paterno"]').value,
        apellidoMaterno: section.querySelector('[name="apellido-materno"]').value,
        domicilio: {
          ubicacion: section.querySelector('[name="ubicacion"]').value,
          departamento: section.querySelector('[name="departamento"]').value,
          provincia: section.querySelector('[name="provincia"]').value,
          distrito: section.querySelector('[name="distrito"]').value,
          tipoVia: section.querySelector('[name="tipo-via"]').value,
          via: section.querySelector('[name="via"]').value,
          numeroMunicipal: section.querySelector('[name="numero-municipal"]').value,
          numeroInterior: section.querySelector('[name="numero-interior"]').value,
          habilitacionUrbana: section.querySelector('[name="habilitacion-urbana"]').value,
          grupoHU: section.querySelector('[name="grupo-HU"]').value,
          manzana: section.querySelector('[name="manzana"]').value,
          lote: section.querySelector('[name="lote"]').value,
          subLote: section.querySelector('[name="sub-lote"]').value,
          telefono: section.querySelector('[name="telefono"]').value,
          anexo: section.querySelector('[name="anexo"]').value,
          correo: section.querySelector('[name="correo"]').value,
        },
        caracteristicas: {
          condicionTitular: section.querySelector('[name="condicion-titular"]').value,
          formaAdquisicion: section.querySelector('[name="forma-adquisicion"]').value,
        },
      });
    }

    if (tipo === 'juridica') {
      personas.push({
        id,
        tipo,
        ruc: section.querySelector('[name="ruc"]').value,
        razonSocial: section.querySelector('[name="razon-social"]').value,
        tipoPJ: section.querySelector('[name="persona-juridica"]').value,
        domicilio: {
          ubicacion: section.querySelector('[name="ubicacion"]').value,
          departamento: section.querySelector('[name="departamento"]').value,
          provincia: section.querySelector('[name="provincia"]').value,
          distrito: section.querySelector('[name="distrito"]').value,
          tipoVia: section.querySelector('[name="tipo-via"]').value,
          via: section.querySelector('[name="via"]').value,
          numeroMunicipal: section.querySelector('[name="numero-municipal"]').value,
          numeroInterior: section.querySelector('[name="numero-interior"]').value,
          habilitacionUrbana: section.querySelector('[name="habilitacion-urbana"]').value,
          grupoHU: section.querySelector('[name="grupo-hu"]').value,
          manzana: section.querySelector('[name="manzana"]').value,
          lote: section.querySelector('[name="lote"]').value,
          subLote: section.querySelector('[name="sub-lote"]').value,
          telefono: section.querySelector('[name="telefono"]').value,
          anexo: section.querySelector('[name="anexo"]').value,
          correo: section.querySelector('[name="correo"]').value,
        },
        caracteristicas: {
          condicionTitular: section.querySelector('[name="condicion-titular"]').value,
          formaAdquisicion: section.querySelector('[name="forma-adquisicion"]').value,
        },
      });
    }
  });

  return personas;
}

function obtenerVias() {
  const contenedor = document.getElementById('contenedor-vias');
  const vias = [];

  contenedor.querySelectorAll('[data-via]').forEach((viaEl) => {
    const viaId = viaEl.dataset.via;
    const via = {
      id: viaId,
      tipo_via_id: viaEl.querySelector('.input-hidden-tipo-via')?.value || null,
      via_id: viaEl.querySelector('.input-hidden-via')?.value || null,
      puertas: [],
    };

    viaEl.querySelectorAll('[data-puerta]').forEach((puertaEl) => {
      via.puertas.push({
        id: puertaEl.dataset.puerta,
        tipo: puertaEl.querySelector('.puerta-tipo')?.value || null,
        numero: puertaEl.querySelector('.puerta-numero')?.value || null,
      });
    });

    vias.push(via);
  });

  return vias;
}
