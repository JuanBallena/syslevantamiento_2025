<?php

$ev_1="onBlur='javascript:novacio(this);' onChange='javascript:valida_ficha(this);' ";
$ev_2="onBlur='javascript:novacio(this);' onChange='javascript:rellenar_campo(this,2);valida_sector(this);valida_referenciacatastral();' ";

//Sólo Números
$N="onKeyPress='javascript:return validar_numeros(event);'";
$Ncoma="onKeyPress='javascript:return validar_numeros_coma(event);'";
//Sólo letras
$L="onKeyPress='javascript:return letras(event);'";
//Todo a Mayúsculas
$M="onKeyUp='javascript:validar_todo_mayus(this);'";
//Validar Email
$E="onKeyUp='javascript:validarEmail(this);'";
//Validar Fechas
$VF="onKeyUp = 'javascript:this.value=formateafecha(this.value);'";
//Sólo Letras Mayúsculas
$LyM="onKeyPress='javascript:return letras(event);' onKeyUp='javascript:validar_todo_mayus(this);'";
//Copiar casilleros
//$C="onKeyUp='javascript:document.getElementById('$a2').value = document.getElementById('$a1').value.substring(0,10);'";
//No vacios
$NV="onBlur='javascript:novacio(this);'";
//Cálculo de Casillero DC
$DC="onBlur='javascript:calcula_dc(this);'";
//Rellenar con ceros
$dos="onBlur='javascript:rellenar_2(this,this.value);'";
$tres="onBlur='javascript:rellenar_3(this,this.value);'";
$cuatro="onBlur='javascript:rellenar_4(this,this.value);'";
$seis="onBlur='javascript:rellenar_6(this,this.value);'";
//bloqueos
$B="onclick='javascript:bloqueos(this);'";
$Entero="onBlur='javascript:set_numero(this);'";
$Decimal="onBlur='javascript:set_decimal(this);'";

?>