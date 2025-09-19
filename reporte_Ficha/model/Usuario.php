<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Usuario
{

    public $c_usuario;
    public $c_nombres;
    public $c_ape_paterno;
    public $c_ape_materno;

	public function Listar()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();	
			$consulta ="SELECT * FROM tf_usuario";
			$consulta_usuario= $BD->Consultas($consulta);
			$usuarios=pg_fetch_all($consulta_usuario);
			if(!empty($usuarios))
				return $usuarios;
			else
				echo "";
	}

	public function ObtenerUsuario($id)
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$Consulta="SELECT c_id_usuario,c_usuario, c_nombres, c_ape_paterno, c_ape_materno ".
					  "FROM tf_usuario ".
					  "WHERE c_usuario = '$id' ";
			$consulta_usuario= $BD->Consultas($Consulta);
			
			$usuario=pg_fetch_array($consulta_usuario);
			
			if(!empty($usuario))
				return $usuario;
			else
				echo "";
	}

	public function ComboUsuario()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$Consulta="SELECT c_nombres || ' ' || c_ape_paterno || ' ' || c_ape_materno as nombre,c_id_usuario  ".
					  "FROM tf_usuario ";
			$consulta_usuario= $BD->Consultas($Consulta);
			
			$usuario=pg_fetch_all($consulta_usuario);
			
			if(!empty($usuario))
				return $usuario;
			else
				echo "";
	}
}