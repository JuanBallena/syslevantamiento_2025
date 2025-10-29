function soloNumeros(input) {
  input.value = input.value.replace(/[^0-9]/g, '');
}

function limitarCaracteres(input, max) {
  if (input.value.length > max) {
    input.value = input.value.slice(0, max);
  }
}
