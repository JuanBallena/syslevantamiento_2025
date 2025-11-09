function soloNumeros(input) {
  input.value = input.value.replace(/[^0-9]/g, '');
}

function limitarCaracteres(input, max) {
  if (input.value.length > max) {
    input.value = input.value.slice(0, max);
  }
}

document.querySelectorAll('.autocompletar-2digitos').forEach((input) => {
  input.addEventListener('blur', function () {
    let value = this.value;

    if (value !== '') {
      this.value = value.toString().padStart(2, '0');
    }
  });
});

document.querySelectorAll('.autocompletar-3digitos').forEach((input) => {
  input.addEventListener('blur', function () {
    let value = this.value;

    if (value !== '') {
      this.value = value.toString().padStart(3, '0');
    }
  });
});
