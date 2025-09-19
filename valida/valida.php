<?php

session_set_cookie_params(time() + 600);

session_start();

include("../configuracion/classusuario.php");

$lg = strtolower($_POST['login']);
$pass = $_POST['password'];

$_SESSION['login'] = $lg;

/* Validación de los campos de ingreso */
if ($lg == '') {
    echo "<script>alert('Debe ingresar un Usuario!');
    				document.location.href='../login.php';</script>\n";
}

if ($pass == '') {
    echo "<script>alert('Debe ingresar su Contraseña!');
	    			document.location.href='../login.php';</script>\n";
}
/* Validacion de la Conexion */
$BaseDato = new BaseDeDato(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
$con = $BaseDato->Conectar();

if ($con == 0) {
    echo "<script>alert('No Existe conexión');
    			document.location.href='../login.php';</script>\n";
} elseif ($con) {
    // Debo consultar el usuario y su clave
    $usuario = new Usuario($lg, $pass);
    $return = $usuario->Buscar();

    $_SESSION['login'] = $lg;
} else {
    echo "<script>alert('¡Clave Incorrecta!');
					document.location.href='../inicio.php';</script>\n";
    exit();
}
