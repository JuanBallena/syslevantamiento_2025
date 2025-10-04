<?php

function limpiarArray($arr)
{
  return array_map(function ($v) {
    return is_string($v) ? trim($v) : $v;
  }, $arr);
}
