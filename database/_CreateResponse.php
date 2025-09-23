<?php

function createResponse($success, $data = [], $error = null)
{
  echo json_encode([
    "success" => $success,
    "data" => $data,
    "error" => $error
  ], JSON_UNESCAPED_UNICODE);
  exit;
}
