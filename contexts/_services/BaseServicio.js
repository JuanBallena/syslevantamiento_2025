class BaseServicio {
  /**
   * Realiza una petición al servidor
   * @param {string} endpoint - Endpoint relativo (p. ej. 'obtenerManzanas.php')
   * @param {object} data - Datos a enviar. Para GET se convierten en query string
   * @param {string} method - 'GET' o 'POST'
   * @returns {Promise<object>} - Respuesta JSON
   */
  static async request(endpoint, data = {}, method = 'POST') {
    let url = window.API_BASE + endpoint;

    // Si es GET, convertimos data en query string
    if (method.toUpperCase() === 'GET' && Object.keys(data).length) {
      const params = new URLSearchParams(data).toString();
      url += `?${params}`;
    }

    try {
      const res = await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json',
        },
        body: method.toUpperCase() !== 'GET' ? JSON.stringify(data) : null,
      });

      return await res.json();
    } catch (err) {
      console.error('Error BaseServicio:', err);
      return {
        success: false,
        error: 'Error de comunicación con el servidor.',
      };
    }
  }
}
