<?php

define("API_BASE_URL", "http://localhost:8080/syslevantamiento/database/");

function callApiPost(string $endpoint, array $data = []): array
{
  $url = API_BASE_URL . $endpoint;

  $ch = curl_init($url);

  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS => json_encode($data),
  ]);

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    throw new Exception("❌ Error cURL: " . curl_error($ch));
  }

  curl_close($ch);

  $result = json_decode($response, true);

  if ($result === null) {
    throw new Exception("❌ Respuesta no es JSON válido: " . $response);
  }

  return $result;
}

function callApiGet(string $endpoint, array $params = []): array
{
  $url = API_BASE_URL . $endpoint;

  if (!empty($params)) {
    $url .= '?' . http_build_query($params);
  }

  $ch = curl_init($url);

  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
  ]);

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    throw new Exception("❌ Error cURL: " . curl_error($ch));
  }

  curl_close($ch);

  $result = json_decode($response, true);

  if ($result === null) {
    throw new Exception("❌ Respuesta no es JSON válido: " . $response);
  }

  return $result;
}
