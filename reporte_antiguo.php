<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consulta de Fichas</title>
  <link rel="stylesheet" href="reportes/library/jquery-ui.theme.min.css">
  <script src="reportes/library/jquery-1.12.4.min.js"></script>
  <script src="reportes/library/jquery-ui.min.js"></script>
  <script>
    $(function() {
      $("#tabs").tabs();
    } );
  </script>
</head>
<body>
 
<div id="tabs">
  <ul>
    <li><a href="#tabs-1"><i>Fichas Antiguas/i></a></li>
    <li><a href="#tabs-2"><i>Levantamiento Catastral</i></a></li>
  </ul>

  <div id="tabs-1">
    <?php require_once("reportes/consulta_reporte.php"); ?>
  </div>

  <div id="tabs-2">
    <?php require_once("reportes/consulta_reporte_2.php"); ?>
  </div>
</div>
</body>
</html>