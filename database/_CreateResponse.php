<?php

require_once "./_LimpiarArray.php";

function createResponse($success, $data = [], $error = null)
{
  echo json_encode([
    "success" => $success,
    "data" => limpiarArray($data),
    "error" => $error
  ], JSON_UNESCAPED_UNICODE);
  exit;
}
