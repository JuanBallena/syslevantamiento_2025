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

  parseName(name) {
    return name.replace(/\]/g, '').split('[');
  }

  setDeep(obj, pathArray, value) {
    let current = obj;
    pathArray.forEach((key, i) => {
      const isLast = i === pathArray.length - 1;
      const nextKey = pathArray[i + 1];

      if (!isLast) {
        if (!current[key]) {
          current[key] = isNaN(nextKey) ? {} : [];
        }
        current = current[key];
      } else {
        current[key] = value;
      }
    });
  }

  // ---------------------------------------------------------------
  // Nuevo: Obtiene el ID de la sección donde se encuentra el input
  // ---------------------------------------------------------------
  getSectionId(el) {
    let node = el.parentElement;
    while (node && node !== this.form) {
      if (node.id) return node.id;
      node = node.parentElement;
    }
    return null; // Si no se encuentra sección, no se guarda
  }

  // ---------------------------------------------------------------
  // Nuevo: Guardar por secciones
  // ---------------------------------------------------------------
  save() {
    const saved = JSON.parse(localStorage.getItem(this.storageKey) || '{}');

    [...this.form.elements].forEach((el) => {
      if (!el.name) return;

      const sectionId = this.getSectionId(el);
      if (!sectionId) return;

      if (!saved[sectionId]) saved[sectionId] = {};

      const path = this.parseName(el.name);
      const value = el.type === 'checkbox' || el.type === 'radio' ? el.checked : el.value;

      this.setDeep(saved[sectionId], path, value);
    });

    localStorage.setItem(this.storageKey, JSON.stringify(saved));
  }

  // ---------------------------------------------------------------
  // Nuevo: Restaurar por secciones
  // ---------------------------------------------------------------
  restore() {
    const saved = JSON.parse(localStorage.getItem(this.storageKey) || '{}');

    Object.keys(saved).forEach((sectionId) => {
      const section = this.form.querySelector(`#${sectionId}`);
      if (!section) return;

      const restoreRecursive = (obj, prefix = '') => {
        Object.keys(obj).forEach((key) => {
          const fullName = prefix ? `${prefix}[${key}]` : key;
          const value = obj[key];

          if (typeof value === 'object' && value !== null) {
            restoreRecursive(value, fullName);
          } else {
            const field = section.querySelector(`[name="${fullName}"]`);
            if (!field) return;

            if (field.type === 'checkbox' || field.type === 'radio') {
              if (!field.defaultChecked) field.checked = value;
            } else {
              if (!field.value) field.value = value;
            }
          }
        });
      };

      restoreRecursive(saved[sectionId]);
    });
  }

  registerEvents() {
    this.form.addEventListener('input', () => this.save());
    this.form.addEventListener('change', () => this.save());

    const observer = new MutationObserver(() => this.save());
    observer.observe(this.form, { subtree: true, childList: true, attributes: true });
  }

  clear() {
    localStorage.removeItem(this.storageKey);
    console.log(`FormBackup: Backup "${this.storageKey}" eliminado`);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  window.backup = new FormBackup(
    '#formulario-ficha-urbana-individual',
    'backup_ficha_urbana_individual'
  );

  // console.log('Guardando...');
});

// class FormBackup {
//   constructor(formSelector, storageKey = 'form_backup') {
//     this.form = document.querySelector(formSelector);
//     this.storageKey = storageKey;

//     if (!this.form) {
//       console.error(`FormBackup: No se encontró el formulario "${formSelector}"`);
//       return;
//     }

//     this.restore();
//     this.registerEvents();
//   }

//   // -----------------------------------------------------
//   // Convierte names con formato "a[b][c][0][x]" en paths
//   // -----------------------------------------------------
//   parseName(name) {
//     return name.replace(/\]/g, '').split('[');
//   }

//   // -----------------------------------------------------
//   // Asigna valor profundo según el name del input
//   // -----------------------------------------------------
//   setDeep(obj, pathArray, value) {
//     let current = obj;

//     pathArray.forEach((key, i) => {
//       const isLast = i === pathArray.length - 1;

//       if (!isLast) {
//         // Crear array si el siguiente índice es numérico
//         const nextKey = pathArray[i + 1];
//         if (!current[key]) {
//           current[key] = isNaN(nextKey) ? {} : [];
//         }
//         current = current[key];
//       } else {
//         current[key] = value;
//       }
//     });
//   }

//   // -----------------------------------------------------
//   // Lee el formulario y lo guarda como objeto anidado
//   // -----------------------------------------------------
//   save() {
//     const data = {};

//     [...this.form.elements].forEach((el) => {
//       if (!el.name) return;

//       const path = this.parseName(el.name);
//       const value = el.type === 'checkbox' || el.type === 'radio' ? el.checked : el.value;

//       this.setDeep(data, path, value);
//     });

//     localStorage.setItem(this.storageKey, JSON.stringify(data));
//   }

//   // -----------------------------------------------------
//   // Restaura un input si coincide el name exacto
//   // Sin sobrescribir valores predeterminados.
//   // -----------------------------------------------------
//   restore() {
//     const saved = localStorage.getItem(this.storageKey);
//     if (!saved) return;

//     const data = JSON.parse(saved);

//     const restoreRecursive = (obj, prefix = '') => {
//       Object.keys(obj).forEach((key) => {
//         const fullName = prefix ? `${prefix}[${key}]` : key;
//         const value = obj[key];

//         if (typeof value === 'object' && value !== null) {
//           restoreRecursive(value, fullName);
//         } else {
//           const field = this.form.querySelector(`[name="${fullName}"]`);
//           if (!field) return;

//           // No sobrescribir valores predeterminados
//           if (field.type === 'checkbox' || field.type === 'radio') {
//             if (!field.defaultChecked) field.checked = value;
//           } else {
//             if (!field.value) field.value = value;
//           }
//         }
//       });
//     };

//     restoreRecursive(data);
//   }

//   registerEvents() {
//     // Cambios manuales del usuario
//     this.form.addEventListener('input', () => this.save());

//     // Cambios en selects o cambios hechos por JS
//     this.form.addEventListener('change', () => this.save());

//     // Mutaciones del DOM (por ejemplo: agregar vías, puertas, inputs nuevos)
//     const observer = new MutationObserver(() => this.save());
//     observer.observe(this.form, {
//       subtree: true,
//       childList: true,
//       attributes: true,
//     });
//   }

//   clear() {
//     localStorage.removeItem(this.storageKey);
//     console.log(`FormBackup: Backup "${this.storageKey}" eliminado`);
//   }
// }

// document.addEventListener('DOMContentLoaded', () => {
//   window.backup = new FormBackup(
//     '#formulario-ficha-urbana-individual',
//     'backup_ficha_urbana_individual'
//   );

//   console.log('Guardando...');
// });
