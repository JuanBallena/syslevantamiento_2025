<?php
class Fichas_Vias
{

    public $IdUso;
    public $Cod_Uso;
    public $Desc_Uso;

	public function ListarEstados()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$consulta ="SELECT * FROM tf_ficha_vias";
			$consulta_ficha_via= $BD->Consultas($consulta);
			$ficha_Vias=pg_fetch_all($consulta_ficha_via);
			return $ficha_Vias;
	}

	public function ObtenerUltimoFichaVias()
	{
			$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
			$BD->Conectar();
			$consulta ="SELECT max(i_id_ficha_vias) as id FROM tf_ficha_vias";
			$consulta_ultimo= $BD->Consultas($consulta);
			$ficha_Vias=pg_fetch_array($consulta_ultimo);
			if(!empty($ficha_Vias))
				return $ficha_Vias;
			else
				echo '';	
		
	}
}