// VALIDACION NUMERO DE FICHA
document.addEventListener('DOMContentLoaded', () => {
  const ficha = document.getElementById('ficha');
  if (!ficha) return console.error('No se encontró el elemento #ficha');

  const inputNumeroFicha = ficha.querySelector('input[name="numero_ficha"]');
  if (!inputNumeroFicha) return console.error('No se encontró el input numero_ficha');

  inputNumeroFicha.addEventListener('keyup', async () => {
    const valor = inputNumeroFicha.value.trim();
    if (!valor) return console.warn('El número de ficha no puede estar vacío.');

    await buscarFichaPorNumeroFicha(valor);
  });

  async function buscarFichaPorNumeroFicha(numeroFicha) {
    try {
      const res = await fetch('../../database/obtenerFichaPorNumeroFicha.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ numero_ficha: numeroFicha }),
      });

      const data = await res.json();

      if (data.success) {
        alert(data.error);

        ficha.querySelector('input[name="numero_ficha"]').value = '';
      }
    } catch (err) {
      console.error('❌ Error cargando ficha:', err);
    }
  }
});

// VALIDAR
const inputs = document.querySelectorAll(
  '#ubigeo input[name], #codigo-referencia-catastral input[name]'
);

const listaSectores = document.getElementById('autocompletado-lista-sectores');

async function verificarCamposLlenos() {
  const todosLlenos = Array.from(inputs).every((input) => input.value.trim() !== '');

  if (todosLlenos) {
    await ejecutarLogica();
  } else {
    // console.log('⚠️ Falta completar algún campo');
  }
}

listaSectores.addEventListener('click', (e) => {
  const li = e.target.closest('li');
  if (li) {
    setTimeout(verificarCamposLlenos, 100);
  }
});

inputs.forEach((input) => {
  input.addEventListener('input', verificarCamposLlenos);
  input.addEventListener('change', verificarCamposLlenos);
});

async function ejecutarLogica() {
  const ficha = document.getElementById('ficha');
  const ubigeo = document.getElementById('ubigeo');

  const anio = new Date().getFullYear();
  const departamento = ubigeo.querySelector('[name="departamento"]').value;
  const provincia = ubigeo.querySelector('[name="provincia"]').value;
  const distrito = ubigeo.querySelector('[name="distrito"]').value;
  const tipoFicha = '01';
  const numeroFicha = ficha.querySelector('[name="numero_ficha"]').value;

  let codigoNuevo = `${anio}${departamento}${provincia}${distrito}${tipoFicha}${numeroFicha}`;
}
