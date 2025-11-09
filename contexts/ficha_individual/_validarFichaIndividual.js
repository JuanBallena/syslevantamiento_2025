async function validarNumeFicha(e) {
  const numeFicha = e.value.trim();
  const errorNumeFicha = document.querySelector('.error-nume-ficha');
  errorNumeFicha.textContent = '';

  if (numeFicha) {
    try {
      const res = await fetch('../../database/obtenerFichaPorNumeroFicha.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nume_ficha: numeFicha }),
      });

      const data = await res.json();

      if (data.success) {
        errorNumeFicha.textContent = data.error;
      }
    } catch (err) {
      console.log('Error validar nume ficha:', err);
    }
  }
}

async function validarIdFicha() {
  const inputs = document.querySelectorAll('#codigo-referencia-catastral input.a-input-text');

  const todosLlenos = Array.from(inputs).every((i) => i.value.trim() !== '');

  if (todosLlenos) {
    try {
      // const res = await fetch('../../database/obtenerFichaPorNumeroFicha.php', {
      //   method: 'POST',
      //   headers: { 'Content-Type': 'application/json' },
      //   body: JSON.stringify({ nume_ficha: numeFicha }),
      // });
      // const data = await res.json();
      // if (data.success) {
      //   errorNumeFicha.textContent = data.error;
      // }
    } catch (err) {
      console.log('Error validar id ficha:', err);
    }
  }
}
