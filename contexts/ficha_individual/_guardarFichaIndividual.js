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
    obrasComplementarias: obtenerObrasComplementarias(),
    informacionComplementaria: obtenerInformacionComplementaria(),
    litigantes: obtenerLitigantes(),
    observaciones: obtenerObservaciones(),
    inscripcionPredioCatastral: obtenerInscripcionPredioCatastral(),
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

  console.log('📦 Enviando dataPost:', dataPost);

  try {
    const response = await fetch('../../database/guardarInformacionCatastral.php', {
      method: 'POST',
      body: formData,
    });

    // ✅ Leer la respuesta como texto primero
    const text = await response.text();
    console.log('📄 Respuesta cruda del servidor:', JSON.parse(text));

    let result;
    try {
      result = JSON.parse(text); // intentar convertir a JSON
    } catch (e) {
      console.error(
        '⚠️ La respuesta no es JSON válido. Revisa el texto anterior (probablemente un error de PHP).'
      );
      return;
    }

    // ✅ Procesar normalmente
    if (result.success) {
      console.log('✅ Éxito:', result);
    } else {
      mostrarErrores(text);
      console.error('❌ Error del servidor:', result.message);
    }
  } catch (err) {
    console.error('💥 Error de red o fetch:', err);
  }
});

function mostrarErrores(text) {
  // if (!result.success) {
  const errorMsg = text?.toLowerCase() || '';
  let mensaje = '';
  // let mensaje = '❌ Ocurrió un error al guardar la información.';

  if (errorMsg.includes('llave duplicada')) {
    if (errorMsg.includes('lotes')) {
      mensaje = '⚠️ El lote ya fue registrado anteriormente.';
    } else if (errorMsg.includes('edificacion')) {
      mensaje = '⚠️ La edificación ya existe para este lote.';
    } else if (errorMsg.includes('puerta')) {
      mensaje = '⚠️ Ya existe una puerta registrada con ese código.';
    }
  }

  // mostrarMensaje(mensaje);
  alert(mensaje);
  // }
}

function obtenerNumeroFicha() {
  const ficha = document.getElementById('ficha');
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
    idSector: codigoReferenciaCatastral.querySelector('[name="id_sector"]').value,
    idManzana: codigoReferenciaCatastral.querySelector('[name="id_manzana"]').value,
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
    grupoHU: ubicacionPredioCatastral.querySelector('[name="grupo_HU"]').value,
    idHU: ubicacionPredioCatastral.querySelector('[name="id_HU"]').value,
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

    const domicilio = {
      ubicacion: section.querySelector('[name="ubicacion"]').value,
      codigoDepartamento: section.querySelector('[name="codigo_departamento"]').value,
      codigoProvincia: section.querySelector('[name="codigo_provincia"]').value,
      codigoDistrito: section.querySelector('[name="codigo_distrito"]').value,
      tipoVia: section.querySelector('[name="tipo_via"]').value,
      codigoVia: section.querySelector('[name="codigo_via"]').value,
      nombreVia: section.querySelector('[name="nombre_via"]').value,
      numeroMunicipal: section.querySelector('[name="numero_municipal"]').value,
      numeroInterior: section.querySelector('[name="numero_interior"]').value,
      codigoHU: section.querySelector('[name="codigo_HU"]').value,
      nombreHU: section.querySelector('[name="nombre_HU"]').value,
      grupoHU: section.querySelector('[name="grupo_HU"]').value,
      zonaSectorEtapa: section.querySelector('[name="zona_sector_etapa"]').value,
      manzana: section.querySelector('[name="manzana"]').value,
      lote: section.querySelector('[name="lote"]').value,
      subLote: section.querySelector('[name="sub_lote"]').value,
      telefono: section.querySelector('[name="telefono"]').value,
      anexo: section.querySelector('[name="anexo"]').value,
      correo: section.querySelector('[name="correo"]').value,
    };

    const caracteristicas = {
      condicionTitular: section.querySelector('[name="condicion_titular"]').value,
      formaAdquisicion: section.querySelector('[name="forma_adquisicion"]').value,
      fechaAdquisicion: section.querySelector('[name="fecha_adquisicion"]').value,
    };

    if (tipo === 'natural') {
      personas.push({
        id,
        tipo: '1',
        estadoCivil: section.querySelector('[name="estado_civil"]').value,
        tipoDocumento: section.querySelector('[name="tipo_documento"]').value,
        numeroDocumento: section.querySelector('[name="numero_documento"]').value,
        sinDocumento: section.querySelector('[name="sin_documento"]').checked,
        nombres: section.querySelector('[name="nombres"]').value,
        apellidoPaterno: section.querySelector('[name="apellido_paterno"]').value,
        apellidoMaterno: section.querySelector('[name="apellido_materno"]').value,
        domicilio,
        caracteristicas,
      });
    }

    if (tipo === 'juridica') {
      personas.push({
        id,
        tipo: '2',
        ruc: section.querySelector('[name="ruc"]').value,
        razonSocial: section.querySelector('[name="razon_social"]').value,
        tipoPersonaJuridica: section.querySelector('[name="tipo_persona_juridica"]').value,
        domicilio,
        caracteristicas,
      });
    }
  });

  return personas;
}

function obtenerPuertasPredioCatastral() {
  const contenedor = document.getElementById('contenedor-vias');

  const vias = [];

  contenedor.querySelectorAll('[data-via]').forEach((viaEl) => {
    // const viaId = viaEl.dataset.via;
    const via = {
      // id: viaId,
      nombre: viaEl.querySelector('[name="nombre"]')?.value || null,
      tipo: viaEl.querySelector('[name="tipo"]')?.value || null,
      idVia: viaEl.querySelector('[name="id_via"]')?.value.trim() || null,
      puertas: [],
    };

    viaEl.querySelectorAll('[data-puerta]').forEach((puertaEl, index) => {
      via.puertas.push({
        tipo: puertaEl.querySelector('[name="tipo"]')?.value || null,
        codigo: String(index + 1),
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
    result[input.name] = Number(input.checked);
  });

  return result;
}

function obtenerConstrucciones() {
  const filas = document.querySelectorAll('#tabla-construcciones tbody tr');
  const construcciones = [];

  filas.forEach((fila, index) => {
    const datosFila = {};

    fila.querySelectorAll('input[name], select[name]').forEach((el) => {
      datosFila[el.name] = el.value;
    });

    datosFila.codigo = index + 1;

    construcciones.push(datosFila);
  });

  return construcciones;
}

function obtenerObrasComplementarias() {
  const filas = document.querySelectorAll('#tabla-obras-complementarias tbody tr');
  const construcciones = [];

  filas.forEach((fila, index) => {
    const datosFila = {};

    fila.querySelectorAll('input[name], select[name]').forEach((el) => {
      datosFila[el.name] = el.value;
    });

    datosFila.correlativo = index + 1;

    construcciones.push(datosFila);
  });

  return construcciones;
}

function obtenerInscripcionPredioCatastral() {
  const inscripcion = document.getElementById('inscripcion-predio-catastral');
  return {
    tipoPartida: inscripcion.querySelector('[name="tipo_partida"]').value,
    numeroPartida: inscripcion.querySelector('[name="numero_partida"]').value,
    fojas: inscripcion.querySelector('[name="fojas"]').value,
    asiento: inscripcion.querySelector('[name="asiento"]').value,
    fechaInscripcion: inscripcion.querySelector('[name="fecha_inscripcion"]').value,
    codigoDeclaracionFabrica: inscripcion.querySelector('[name="codigo_declarancion_fabrica"]')
      .value,
    asientoFabrica: inscripcion.querySelector('[name="asie_fabrica"]').value,
    fechaFabrica: inscripcion.querySelector('[name="fecha_fabrica"]').value,
  };
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
  // const posiblesUnidades = seccion.querySelector("[name='posibles_unidades']").checked;
  // const subDivision = seccion.querySelector("[name='sub_division']").checked;
  // const independizacion = seccion.querySelector("[name='independización']").checked;

  return {
    condicionDeclarante,
    estadoFicha,
    cantidadMedidores,
    mantenimiento,
    numeroHabitantes,
    numeroFamilias,
    // posiblesUnidades,
    // subDivision,
    // independizacion,
  };
}

function obtenerLitigantes() {
  const filas = document.querySelectorAll('#tabla-litigantes tbody tr');
  const litigantes = [];

  filas.forEach((fila, index) => {
    const datosFila = {};

    fila.querySelectorAll('input[name], select[name]').forEach((el) => {
      datosFila[el.name] = el.value;
    });

    datosFila.codigo = index + 1;

    litigantes.push(datosFila);
  });

  return litigantes;
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
  const codigoCatastralAntiguo = observaciones?.querySelector(
    '[name="codigo_catastral_antiguo"]'
  ).value;

  return {
    texto: campoTexto ? campoTexto.value.trim() : '',
    codigoCatastralAntiguo,
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
