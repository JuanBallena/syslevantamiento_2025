<?php

class BaseDeDato
{
    private $Servidor;
    private $Puerto;
    private $Nombre;
    private $Usuario;
    private $Clave;
    private $link;

    private $connection;

    public function __construct($Servidor, $Puerto, $Nombre, $Usuario, $Clave)
    //function __construct($Servidor,$Puerto,$Nombre,$Usuario)
    {
        $this->Servidor = $Servidor;
        $this->Puerto = $Puerto;
        $this->Nombre = $Nombre;
        $this->Usuario = $Usuario;
        $this->Clave = $Clave;
    }

    public function Conectar()
    {
        $BaseDato = pg_connect("host=$this->Servidor port=$this->Puerto dbname=$this->Nombre user=$this->Usuario password=$this->Clave");

        $this->connection = $BaseDato;
        //return $BaseDato;
        if ($this->connection) {
            return $this->connection;
        } else {
            return 0;
        }
    }

    public function Consultas($Consulta)
    {
        global $Resultado;

        $Valor = $this->Conectar();
        if (!$Valor) {
            return 0;
        } //Si no se pudo conectar
        else {
            //Valor es resultado de base de dato y Consulta es la Consulta a realizar
            $Resultado = pg_query($Valor, $Consulta);
            return $Resultado;// retorna si fue afectada una fila
        }
    }


    public function desconectar()
    {
        pg_close($this->connection);
    }

    public function closeConnection($conecction)
    {
        pg_close($conecction);
    }
}




/* function conectarse(){
 //Cambiar por el servidor, bd, usuario y clave
 $serverName = "LAPTOP-FPIDUEH3\SQLEXPRESS";//serverName\instanceName
 $connectionInfo = array( "Database"=>"FichaAntiguas", "UID"=>null, "PWD"=>null);
 $conn = sqlsrv_connect($serverName, $connectionInfo);

 if( $conn ) {
//     echo "Conexión establecida jejej. :) <br />";
    return $conn;

 }

 else{

echo "Conexión a la base de datos no se pudo establecer :( <br />";
die(print_r(sqlsrv_errors(), true));
 }

/*
 $hostname='SERVERPLAN3\PLANDET2008';
 $dbname='SIMTRUX';
 $username='carlosul';
 $password='urteaga87';

 }*/
