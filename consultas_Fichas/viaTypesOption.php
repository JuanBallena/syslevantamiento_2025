<?php
require_once 'model/Multitabla.php';
require_once 'model/database.php';

$v = file_get_contents("php://input", true);

$oTipoVia = new Multitablas();
$TipoVia = $oTipoVia->ObtenerTipoVia($v);

if (!empty($TipoVia)) {
  echo json_encode($TipoVia);
} else {
  echo "";
}
?>

