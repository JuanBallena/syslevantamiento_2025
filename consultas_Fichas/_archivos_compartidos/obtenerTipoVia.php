<?php

function obtenerTipoVia($tipo)
{
  // Mapeo de códigos a abreviaturas
  $tipoVias = [
    "01" => "AV",
    "02" => "CA",
    "05" => "JR",
    "04" => "PSJ",
    "07" => "CTRA",
    "08" => "PRLG",
    "AL" => "AL",
    "PS" => "PS",
    "ML" => "ML",
    "CAM" => "CAM",
  ];

  // Retorna el valor si existe, sino null
  return $tipoVias[$tipo] ?? null;
}
