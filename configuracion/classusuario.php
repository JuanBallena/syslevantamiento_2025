<?php

include_once("conexion.php");
include("constantes.php");

class Usuario
{
    private $login;
    private $contrasena;

    public function __construct($login, $contrasena)
    {
        $this->login = $login;
        $this->contrasena = md5($contrasena);
    }

    public function Buscar()
    {
        global $Datos;

        $BaseDato = new BaseDeDato(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);//declarar el objeto de la clase base de dato
        $Consulta = "SELECT * FROM tf_usuarios AS a WHERE (a.usuario='$this->login') AND (a.clave='$this->contrasena')";//declarar la consulta
        $Resultado = $BaseDato->Consultas($Consulta);//llamar a la funcion de la base de dato que realiza las consulta

        $Datos = @pg_fetch_all($Resultado);//Devuelve los datos en forma de arreglo

        // Aqui mostramos el arreglo
        /*
            echo "<pre>";
            print_r($Datos);
            echo "</pre>";
        */
        if ($Datos[0]['estado'] == '1') {
            echo "<script>alert('Usuario no activado por Administrador!');
                  document.location.href='../login.php';</script>\n";
        }

        if ($Datos[0]['usuario']) {
            //verificar si arrojo algun resultado
            //aqui confirmamos la validaci�n
            /* echo "<script>alert('SI VALID�!');</script>\n";  */
            $row = $Datos;
            $id = trim($row[0]['id_usuario']);
            $n = ucfirst($row[0]['nombres']);
            $ap = ucfirst($row[0]['ape_paterno']);
            $am = ucfirst($row[0]['ape_materno']);
            $tipo_isu = $row[0]['tipo_usuario'];
            /* echo "<script>alert($id);</script>\n"; */

            //$nombre = $row[0]['nombre']." ".$row[0]['paterno']." ".$row[0]['materno'];
            $nombre = $n." ".$ap." ".$am;
            $login = $this->login;
            //uso sesiones
            // session_set_cookie_params(time() + 600);

            $_SESSION["usuario"] = $login;
            $_SESSION["nombre"]  = $nombre;
            $_SESSION["id_usuario"] = $id;
            $_SESSION["tipo_usuario"] = $tipo_isu;

            echo "<script>document.location.href='../menu.php';</script>\n";
        } else {
            echo "<script>alert('Usuario y/o Clave Incorrecto(s)  ! ');
         		   document.location.href='../login.php';</script>\n";
            return 0;
        }
    }

    public function Existencia($Condicion)
    {
        $BaseDato = new BaseDeDato(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);

        if ($Condicion == 'login') {
            $Condicion = "login="."'$this->login'";
        } else {
            $Condicion = "contrasena="."'$this->contrasena'";
        }

        $Consulta = "SELECT *FROM tf_usuarios WHERE ".$Condicion;

        $Resultado = $BaseDato->Consultas($Consulta);//llamar a la funcion de la base de dato que realiza las consulta
        $Datos = @pg_fetch_all($Resultado);//Devuelve los datos en forma de arreglo

        if ($Datos[0]['login']) {
            return 1;
        } else {
            return 0;
        }
    }
}
