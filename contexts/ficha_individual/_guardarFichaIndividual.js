document.getElementById('form-ficha-individual').addEventListener('submit', async (event) => {
  event.preventDefault();

  let dataPost = {
    ubigeo: obtenerUbigeo(),
    codigoReferenciaCatastral: obtenerCodigoReferenciaCatastral(),
    ubicacionPredioCatastral: obtenerUbicacionPredioCatastral(),
    identificacionTitularCatastral: obtenerIdentificacionTitularCatastral(),
    puertasPredioCatastral: obtenerPuertasPredioCatastral(),
    descripcionPredio: obtenerDescripcionPredio(),
    serviciosBasicos: obtenerServiciosBasicos(),
    construcciones: obtenerConstrucciones(),
    informacionComplementaria: obtenerInformacionComplementaria(),
    observaciones: obtenerObservaciones(),
    datosTecnicoCatastral: obtenerDatosTecnicoCatastral(),
  };

  const imagenesAdjuntas = obtenerImagenesAdjuntas();

  const formData = new FormData();
  formData.append('file', imagenesAdjuntas);
  formData.append('dataPost', JSON.stringify(dataPost));

  try {
    const response = await fetch('../../database/guardarFichaIndividual.php', {
      method: 'POST',
      body: formData,
    });

    const result = await response.json();
    if (result.success) {
      alert('Ficha guardada correctamente');
    } else {
      alert('Error: ' + result.message);
    }
  } catch (err) {
    console.error('Error en la petición:', err);
  }
});

function obtenerUbigeo() {
  const ubigeo = document.getElementById('ubigeo');
  return {
    departamento: ubigeo.querySelector('[name="departamento"]').value,
    provincia: ubigeo.querySelector('[name="provincia"]').value,
    distrito: ubigeo.querySelector('[name="distrito"]').value,
  };
}

function obtenerCodigoReferenciaCatastral() {
  const codigoReferenciaCatastral = document.getElementById('codigo-referencia-catastral');
  return {
    sector: codigoReferenciaCatastral.querySelector('[name="sector"]').value,
    manzana: codigoReferenciaCatastral.querySelector('[name="manzana"]').value,
    lote: codigoReferenciaCatastral.querySelector('[name="lote"]').value,
    edifica: codigoReferenciaCatastral.querySelector('[name="edifica"]').value,
    entrada: codigoReferenciaCatastral.querySelector('[name="entrada"]').value,
    piso: codigoReferenciaCatastral.querySelector('[name="piso"]').value,
    unidad: codigoReferenciaCatastral.querySelector('[name="unidad"]').value,
  };
}

function obtenerUbicacionPredioCatastral() {
  const ubicacionPredioCatastral = document.getElementById('ubicacion-predio-catastral');
  return {
    estadoUnidad: ubicacionPredioCatastral.querySelector('[name="estado-unidad"]').value,
    habilitacionUrbana: ubicacionPredioCatastral.querySelector('[name="habilitacion-urbana"]')
      .value,
    grupoHU: ubicacionPredioCatastral.querySelector('[name="grupo-HU"]').value,
    nroEtapa: ubicacionPredioCatastral.querySelector('[name="nro-etapa"]').value,
    manzana: ubicacionPredioCatastral.querySelector('[name="manzana"]').value,
    lote: ubicacionPredioCatastral.querySelector('[name="lote"]').value,
    subLote: ubicacionPredioCatastral.querySelector('[name="sub-lote"]').value,
  };
}

function obtenerIdentificacionTitularCatastral() {
  const personasNaturales = obtenerPersonas('contenedor-personas-naturales', 'natural');
  const personasJuridicas = obtenerPersonas('contenedor-personas-juridicas', 'juridica');
  return {
    personasNaturales,
    personasJuridicas,
  };
}

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

function obtenerPuertasPredioCatastral() {
  const contenedor = document.getElementById('contenedor-vias');

  const vias = [];

  contenedor.querySelectorAll('[data-via]').forEach((viaEl) => {
    const viaId = viaEl.dataset.via;
    const via = {
      id: viaId,
      tipoViaId: viaEl.querySelector('.input-hidden-tipo-via')?.value || null,
      viaId: viaEl.querySelector('.input-hidden-via')?.value || null,
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

function obtenerDescripcionPredio() {
  const contenedor = document.getElementById('descripcion-predio');

  const referenciaUso = contenedor.querySelector('input[name="referencia-uso"]')?.value || '';
  const uso = contenedor.querySelector('.input-hidden-uso')?.value || '';
  const areaTerrenoAdquirida =
    contenedor.querySelector('input[name="area-terreno-adquirida"]')?.value || '';
  const areaTerrenoVerificada =
    contenedor.querySelector('input[name="area-terreno-verificada"]')?.value || '';

  const linderos = [];
  const filas = contenedor.querySelectorAll('table tbody tr');

  filas.forEach((fila) => {
    const medida = fila.querySelector('input[name="medidas-campo[]"]')?.value || '';
    const colindancia = fila.querySelector('input[name="colindancias-campo[]"]')?.value || '';

    linderos.push({
      medida,
      colindancia,
    });
  });

  return {
    referenciaUso,
    uso,
    areaTerrenoAdquirida,
    areaTerrenoVerificada,
    linderos,
  };
}

function obtenerServiciosBasicos() {
  const servicios = document.querySelectorAll('#servicios-basicos input[type="checkbox"]');
  const result = {};

  servicios.forEach((input) => {
    result[input.name] = input.checked;
  });

  return result;
}

function obtenerConstrucciones() {
  const filas = document.querySelectorAll('#tabla-construcciones tbody tr');
  const construcciones = [];

  filas.forEach((fila) => {
    const datosFila = {};
    fila.querySelectorAll('input[name], select[name]').forEach((el) => {
      datosFila[el.name] = el.value;
    });
    construcciones.push(datosFila);
  });

  return construcciones;
}

function obtenerInformacionComplementaria() {
  const section = document.getElementById('informacion-complementaria');

  // 1. Obtener cantidad de medidores
  const cantidadMedidores = section.querySelector('input[name="cantidad-medidores"]').value;

  // 2. Obtener posibles unidades (checkboxes)
  const checkboxes = section.querySelectorAll('input[type="checkbox"]');
  const posiblesUnidades = {};

  checkboxes.forEach((input) => {
    posiblesUnidades[input.name] = input.checked;
  });

  return {
    cantidadMedidores: Number(cantidadMedidores),
    posiblesUnidades,
  };
}

function obtenerImagenesAdjuntas() {
  const section = document.getElementById('imagenes-adjuntas');
  const inputFile = section.querySelector('input[type="file"]');

  // Retornar la lista de archivos seleccionados
  return Array.from(inputFile.files);
}

function obtenerObservaciones() {
  const observaciones = document.getElementById('observaciones');
  return {
    text: observaciones.querySelector('[name="text"]').value,
  };
}

function obtenerDatosTecnicoCatastral() {
  const contenedor = document.getElementById('datos-tecnico-catastral');

  return {
    dni: contenedor.querySelector('[name="dni"]')?.value || '',
    nombres: contenedor.querySelector('[name="nombres"]')?.value || '',
    apellidoPaterno: contenedor.querySelector('[name="apellido-paterno"]')?.value || '',
    apellidoMaterno: contenedor.querySelector('[name="apellido-materno"]')?.value || '',
    fechaLevantamiento: contenedor.querySelector('[name="fecha-levantamiento"]')?.value || '',
    usuario: contenedor.querySelector('[name="usuario"]')?.value || '',
  };
}
