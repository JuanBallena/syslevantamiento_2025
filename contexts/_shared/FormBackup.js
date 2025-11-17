class FormBackup {
  constructor(formSelector, storageKey = 'form_backup') {
    this.form = document.querySelector(formSelector);
    this.storageKey = storageKey;

    if (!this.form) {
      console.error(`FormBackup: No se encontró el formulario "${formSelector}"`);
      return;
    }

    this.restore();
    this.registerEvents();
  }

  // 🔵 Restaurar valores desde localStorage sin sobreescribir predeterminados
  restore() {
    const saved = localStorage.getItem(this.storageKey);
    if (!saved) return;

    const data = JSON.parse(saved);

    Object.keys(data).forEach((name) => {
      const field = this.form.querySelector(`[name="${name}"]`);
      if (!field) return;

      // --- REGLA NUEVA ---
      // No reemplazar si el campo ya tiene valor predeterminado
      if (field.type !== 'checkbox' && field.type !== 'radio') {
        if (field.value && field.value.trim() !== '') return; // ya tiene valor → no restaurar
      } else {
        if (field.checked === true) return; // si ya está marcado por defecto → no restaurar
      }
      // ---------------------

      // Restaurar desde respaldo
      if (field.type === 'checkbox' || field.type === 'radio') {
        field.checked = data[name];
      } else {
        field.value = data[name];
      }
    });

    console.log(`FormBackup: Datos restaurados desde "${this.storageKey}"`);
  }

  // Guardar en cada cambio
  registerEvents() {
    this.form.addEventListener('input', () => this.save());
  }

  // Guardar datos del formulario
  save() {
    const data = {};

    [...this.form.elements].forEach((el) => {
      if (!el.name) return;

      if (el.type === 'checkbox' || el.type === 'radio') {
        data[el.name] = el.checked;
      } else {
        data[el.name] = el.value;
      }
    });

    localStorage.setItem(this.storageKey, JSON.stringify(data));
  }

  // Borrar el backup manualmente
  clear() {
    localStorage.removeItem(this.storageKey);
    console.log(`FormBackup: Backup "${this.storageKey}" eliminado`);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const backup = new FormBackup(
    '#formulario-ficha-urbana-individual',
    'backup_ficha_urbana_individual'
  );

  console.log('Guardando...');
});

// Para eliminar datos luego de guardar
function guardar() {
  // tu lógica de guardado...
  backup.clear();
}
