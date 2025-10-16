document.getElementById('form-ficha-individual').addEventListener('submit', async (event) => {
  event.preventDefault();

  let dataPost = {
    numeroFicha: obtenerNumeroFicha(),
    ubigeo: obtenerUbigeo(),
    codigoReferenciaCatastral: obtenerCodigoReferenciaCatastral(),
    ubicacionPredioCatastral: obtenerUbicacionPredioCatastral(),
    identificacionTitularCatastral: obtenerIdentificacionTitularCatastral(),
    puertasPredioCatastral: obtenerPuertasPredioCatastral(),
    descripcionPredio: obtenerDescripcionPredio(),
    evaluacionPredio: obtenerEvaluacionPredio(),
    serviciosBasicos: obtenerServiciosBasicos(),
    construcciones: obtenerConstrucciones(),
    informacionComplementaria: obtenerInformacionComplementaria(),
    observaciones: obtenerObservaciones(),
    declarante: obtenerDatosDeclarante(),
    tecnico: obtenerDatosTecnico(),
    supervisor: obtenerDatosSupervisor(),
    verificador: obtenerDatosVerificador(),
  };

  const imagenesAdjuntas = obtenerImagenesAdjuntas();

  const formData = new FormData();
  formData.append('file', imagenesAdjuntas);
  formData.append('dataPost', JSON.stringify(dataPost));

  console.log(dataPost);

  // try {
  //   const response = await fetch('../../database/guardarFichaIndividualProceso.php', {
  //     method: 'POST',
  //     body: formData,
  //   });

  //   const result = await response.json();
  //   if (result.success) {
  //     console.log(result);
  //   } else {
  //     console.log('Error:');
  //     console.log(result.message);
  //   }
  // } catch (err) {
  //   console.log('Error catch');
  //   console.log(err);
  // }
});

function obtenerNumeroFicha() {
  return ficha.querySelector('[name="numero_ficha"]').value;
}

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
    codigoSector: codigoReferenciaCatastral.querySelector('[name="codigo_sector"]').value,
    codigoManzana: codigoReferenciaCatastral.querySelector('[name="codigo_manzana"]').value,
    codigoLote: codigoReferenciaCatastral.querySelector('[name="codigo_lote"]').value,
    codigoEdifica: codigoReferenciaCatastral.querySelector('[name="codigo_edifica"]').value,
    codigoEntrada: codigoReferenciaCatastral.querySelector('[name="codigo_entrada"]').value,
    codigoPiso: codigoReferenciaCatastral.querySelector('[name="codigo_piso"]').value,
    codigoUnidad: codigoReferenciaCatastral.querySelector('[name="codigo_unidad"]').value,
  };
}

function obtenerUbicacionPredioCatastral() {
  const ubicacionPredioCatastral = document.getElementById('ubicacion-predio-catastral');
  return {
    tipoEdificacion: ubicacionPredioCatastral.querySelector('[name="tipo_edificacion"]').value,
    tipoInterior: ubicacionPredioCatastral.querySelector('[name="tipo_interior"]').value,
    estadoUnidad: ubicacionPredioCatastral.querySelector('[name="estado_unidad"]').value,
    nombreHU: ubicacionPredioCatastral.querySelector('[name="nombre_HU"]').value,
    codigoHU: ubicacionPredioCatastral.querySelector('[name="codigo_HU"]').value,
    grupoHU: ubicacionPredioCatastral.querySelector('[name="grupo_hu"]').value,
    numeroEtapa: ubicacionPredioCatastral.querySelector('[name="numero_etapa"]').value,
    numeroManzana: ubicacionPredioCatastral.querySelector('[name="numero_manzana"]').value,
    lote: ubicacionPredioCatastral.querySelector('[name="lote"]').value,
    subLote: ubicacionPredioCatastral.querySelector('[name="sub_lote"]').value,
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
        estadoCivil: section.querySelector('[name="estado_civil"]').value,
        tipoDocumento: section.querySelector('[name="tipo_documento"]').value,
        numeroDocumento: section.querySelector('[name="numero_documento"]').value,
        sinDocumento: section.querySelector('[name="sin_documento"]').checked,
        nombres: section.querySelector('[name="nombres"]').value,
        apellidoPaterno: section.querySelector('[name="apellido_paterno"]').value,
        apellidoMaterno: section.querySelector('[name="apellido_materno"]').value,
        domicilio: {
          ubicacion: section.querySelector('[name="ubicacion"]').value,
          departamento: section.querySelector('[name="departamento"]').value,
          provincia: section.querySelector('[name="provincia"]').value,
          distrito: section.querySelector('[name="distrito"]').value,
          tipoVia: section.querySelector('[name="tipo_via"]').value,
          via: section.querySelector('[name="via"]').value,
          numeroMunicipal: section.querySelector('[name="numero_municipal"]').value,
          numeroInterior: section.querySelector('[name="numero_interior"]').value,
          habilitacionUrbana: section.querySelector('[name="habilitacion_urbana"]').value,
          grupoHU: section.querySelector('[name="grupo_hu"]').value,
          manzana: section.querySelector('[name="manzana"]').value,
          lote: section.querySelector('[name="lote"]').value,
          subLote: section.querySelector('[name="sub_lote"]').value,
          telefono: section.querySelector('[name="telefono"]').value,
          anexo: section.querySelector('[name="anexo"]').value,
          correo: section.querySelector('[name="correo"]').value,
        },
        caracteristicas: {
          condicionTitular: section.querySelector('[name="condicion_titular"]').value,
          formaAdquisicion: section.querySelector('[name="forma_adquisicion"]').value,
        },
      });
    }

    if (tipo === 'juridica') {
      personas.push({
        id,
        tipo,
        ruc: section.querySelector('[name="ruc"]').value,
        razonSocial: section.querySelector('[name="razon_social"]').value,
        tipoPersonaJuridica: section.querySelector('[name="persona_juridica"]').value,
        domicilio: {
          ubicacion: section.querySelector('[name="ubicacion"]').value,
          departamento: section.querySelector('[name="departamento"]').value,
          provincia: section.querySelector('[name="provincia"]').value,
          distrito: section.querySelector('[name="distrito"]').value,
          tipoVia: section.querySelector('[name="tipo_via"]').value,
          via: section.querySelector('[name="via"]').value,
          numeroMunicipal: section.querySelector('[name="numero_municipal"]').value,
          numeroInterior: section.querySelector('[name="numero_interior"]').value,
          habilitacionUrbana: section.querySelector('[name="habilitacion_urbana"]').value,
          grupoHU: section.querySelector('[name="grupo_hu"]').value,
          manzana: section.querySelector('[name="manzana"]').value,
          lote: section.querySelector('[name="lote"]').value,
          subLote: section.querySelector('[name="sub_lote"]').value,
          telefono: section.querySelector('[name="telefono"]').value,
          anexo: section.querySelector('[name="anexo"]').value,
          correo: section.querySelector('[name="correo"]').value,
        },
        caracteristicas: {
          condicionTitular: section.querySelector('[name="condicion_titular"]').value,
          formaAdquisicion: section.querySelector('[name="forma_adquisicion"]').value,
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
      // id: viaId,
      nombre: viaEl.querySelector('[name="nombre"]')?.value || null,
      tipo: viaEl.querySelector('[name="tipo"]')?.value || null,
      idVia: viaEl.querySelector('[name="id_via"]')?.value.trim() || null,
      puertas: [],
    };

    viaEl.querySelectorAll('[data-puerta]').forEach((puertaEl) => {
      via.puertas.push({
        // id: puertaEl.dataset.puerta,
        tipo: puertaEl.querySelector('[name="tipo"]')?.value || null,
        codigo: '',
        numeroMunicipal: puertaEl.querySelector('[name="numero_municipal"]')?.value || null,
      });
    });

    vias.push(via);
  });

  return vias;
}

function obtenerDescripcionPredio() {
  const contenedor = document.getElementById('descripcion-predio');

  const referenciaUso = contenedor.querySelector('input[name="referencia_uso"]')?.value || '';
  const uso = contenedor.querySelector('.input-hidden-uso')?.value || '';
  const areaTerrenoAdquirida =
    contenedor.querySelector('input[name="area_terreno_adquirida"]')?.value || '';
  const areaTerrenoVerificada =
    contenedor.querySelector('input[name="area_terreno_verificada"]')?.value || '';
  const clasificacionPredio =
    contenedor.querySelector('input[name="clasificacion_predio"]')?.value || '';

  const linderos = [];
  const filas = contenedor.querySelectorAll('table tbody tr');

  filas.forEach((fila) => {
    const medida = fila.querySelector('input[name="medidas_campo[]"]')?.value || '';
    const colindancia = fila.querySelector('input[name="colindancias_campo[]"]')?.value || '';

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
    clasificacionPredio,
    linderos,
  };
}

function obtenerEvaluacionPredio() {
  const evaluacionPredio = document.getElementById('evaluacion-predio');
  return {
    enLoteColindante: evaluacionPredio.querySelector('[name="en_lote_colindante"]').value,
    enAreaPublica: evaluacionPredio.querySelector('[name="en_area_publica"]').value,
    enJardinAislamiento: evaluacionPredio.querySelector('[name="en_jardin_aislamiento"]').value,
    enAreaIntangible: evaluacionPredio.querySelector('[name="en_area_intangible"]').value,
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
  const seccion = document.getElementById('informacion-complementaria');

  const condicionDeclarante = seccion.querySelector("[name='condicion_declarante']").value;
  const estadoFicha = seccion.querySelector("[name='estado_ficha']").value;
  const cantidadMedidores =
    parseInt(seccion.querySelector("[name='cantidad_medidores']").value) || 0;
  const mantenimiento = seccion.querySelector("[name='mantenimiento']").value;
  const numeroHabitantes = parseInt(seccion.querySelector("[name='numero_habitantes']").value) || 0;
  const numeroFamilias = parseInt(seccion.querySelector("[name='numero_familias']").value) || 0;

  // Checkboxes (convertir a booleano)
  const posiblesUnidades = seccion.querySelector("[name='posibles_unidades']").checked;
  const subDivision = seccion.querySelector("[name='sub_division']").checked;
  const independizacion = seccion.querySelector("[name='independización']").checked;

  return {
    condicionDeclarante,
    estadoFicha,
    cantidadMedidores,
    mantenimiento,
    numeroHabitantes,
    numeroFamilias,
    posiblesUnidades,
    subDivision,
    independizacion,
  };
}

function obtenerImagenesAdjuntas() {
  const contenedor = document.getElementById('imagenes-adjuntas');
  // const section = document.getElementById('imagenes_adjuntas[]');
  const inputFile = contenedor.querySelector('[name="imagenes_adjuntas[]"]');

  // Retornar la lista de archivos seleccionados
  return Array.from(inputFile.files);
}

function obtenerObservaciones() {
  const observaciones = document.getElementById('observaciones');
  const campoTexto = observaciones?.querySelector('[name="texto"]');
  return {
    texto: campoTexto ? campoTexto.value.trim() : '',
  };
}

function obtenerDatosDeclarante() {
  const contenedor = document.getElementById('datos-declarante');

  return {
    dni: contenedor.querySelector('[name="dni"]')?.value || '',
    nombres: contenedor.querySelector('[name="nombres"]')?.value || '',
    apellidoPaterno: contenedor.querySelector('[name="apellido_paterno"]')?.value || '',
    apellidoMaterno: contenedor.querySelector('[name="apellido_materno"]')?.value || '',
    fecha: contenedor.querySelector('[name="fecha"]')?.value || '',
  };
}

function obtenerDatosSupervisor() {
  const contenedor = document.getElementById('datos-supervisor');

  return {
    dni: contenedor.querySelector('[name="dni"]')?.value || '',
    nombres: contenedor.querySelector('[name="nombres"]')?.value || '',
    apellidoPaterno: contenedor.querySelector('[name="apellido_paterno"]')?.value || '',
    apellidoMaterno: contenedor.querySelector('[name="apellido_materno"]')?.value || '',
    fecha: contenedor.querySelector('[name="fecha"]')?.value || '',
  };
}

function obtenerDatosTecnico() {
  const contenedor = document.getElementById('datos-tecnico');

  return {
    dni: contenedor.querySelector('[name="dni"]')?.value || '',
    nombres: contenedor.querySelector('[name="nombres"]')?.value || '',
    apellidoPaterno: contenedor.querySelector('[name="apellido_paterno"]')?.value || '',
    apellidoMaterno: contenedor.querySelector('[name="apellido_materno"]')?.value || '',
    fecha: contenedor.querySelector('[name="fecha"]')?.value || '',
    usuario: contenedor.querySelector('[name="usuario"]')?.value || '',
  };
}

function obtenerDatosVerificador() {
  const contenedor = document.getElementById('datos-verificador');

  return {
    dni: contenedor.querySelector('[name="dni"]')?.value || '',
    nombres: contenedor.querySelector('[name="nombres"]')?.value || '',
    apellidoPaterno: contenedor.querySelector('[name="apellido_paterno"]')?.value || '',
    apellidoMaterno: contenedor.querySelector('[name="apellido_materno"]')?.value || '',
    fecha: contenedor.querySelector('[name="fecha"]')?.value || '',
    numeroRegistro: contenedor.querySelector('[name="numero_registro"]')?.value || '',
  };
}
