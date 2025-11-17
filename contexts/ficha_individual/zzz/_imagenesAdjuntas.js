async function guardarArchivos() {
  const section = document.getElementById('imagenes-adjuntas');
  // Obtener el input (NO el NodeList)
  const input = section.querySelector('#input-archivos');

  if (!input || !input.files || input.files.length === 0) {
    console.warn('No hay archivos seleccionados');
    return;
  }

  const formData = new FormData();

  // Añadir cada archivo a formData bajo la key 'archivos[]' (coincide con PHP)
  for (const file of input.files) {
    formData.append('archivos[]', file);
  }

  try {
    const response = await fetch('../../database/guardarArchivos.php', {
      method: 'POST',
      body: formData,
    });

    // Leer respuesta cruda
    const text = await response.text();
    console.log('📄 Respuesta cruda del servidor:', text);

    let result;
    try {
      result = JSON.parse(text);
    } catch (e) {
      console.error(
        '⚠️ La respuesta no es JSON válido. Revisa la respuesta cruda (puede ser un error/advertencia de PHP).'
      );
      // Opcional: mostrar la respuesta en pantalla para debug
      alert('Respuesta no JSON: abre consola para ver detalles.');
      return;
    }

    if (result.success) {
      console.log('✅ Éxito:', result);
      // Aquí puedes actualizar la UI con las URLs devueltas
    } else {
      console.error('❌ Error del servidor:', result.error ?? result.message);
      alert('Error: ' + (result.error ?? result.message));
    }
  } catch (err) {
    console.error('💥 Error de red o fetch:', err);
    alert('Error de red. Revisa la consola.');
  }
}
