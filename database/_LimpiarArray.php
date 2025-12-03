<?php

function limpiarArray($data)
{
  if (!is_array($data)) {
    return $data;
  }

  return array_map(function ($item) {
    return is_array($item) ? limpiarArray($item) : $item;
  }, $data);
}
