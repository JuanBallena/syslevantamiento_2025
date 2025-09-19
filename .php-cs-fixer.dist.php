<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
  ->in(__DIR__) // Busca en el directorio del proyecto
  ->name('*.php') // Solo aplica a archivos PHP
  ->notName('*.blade.php') // Excluye archivos Blade (opcional)
  ->exclude(['vendor', 'node_modules']); // Excluye ciertas carpetas

return (new Config())
  ->setIndent("  ") // Configura la indentación con 2 espacios
  ->setRules([
    '@PSR12' => true, // Aplica las reglas del estándar PSR-12
    'indentation_type' => true, // Asegura que se use espacio y no tabulación
    'array_indentation' => true, // Indentación en arrays
    'method_chaining_indentation' => true, // Indentación en llamadas encadenadas
    'binary_operator_spaces' => [
      'default' => 'single_space', // Espacio simple alrededor de operadores
    ],
    'no_trailing_whitespace' => true, // Elimina espacios al final de las líneas
    'single_blank_line_at_eof' => true, // Una línea en blanco al final del archivo
  ])
  ->setFinder($finder);
