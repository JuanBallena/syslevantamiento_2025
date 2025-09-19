<?php
require_once 'model/database_catastro.php';
require_once 'model/constantes.php';
class Construcciones_p
{

	public $IdConstruc;
	public $Id_Ficha;
	public $Nro_Piso;
	public $Mes;
	public $Anio;
	public $Mep;
	public $Ecs;
	public $Ecc;
	public $Estru_Muro_Col;
	public $Estru_Techo;
	public $Acaba_Piso;
    public $Acaba_Puerta_Ven;
    public $Acaba_Revest;
    public $Acaba_Bano;
    public $Inst_Elect_Sanita;
    public $Area_Declarada;
    public $Area_Verificada;
    public $Uca;

	public function ObtenerDatosConstrucciones($id)
	{
		$BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);   
		$BD->Conectar();
		$Consulta="SELECT distinct c.c_id_uni_cat,p.c_cod_pisos as idpisos, p.c_desc_pisos as pisos, ".
				  "tc.i_cod_tip_categoria as idmuro, tc.c_des_tip_categoria as muro, ".
				  "tc1.i_cod_tip_categoria as idtecho, tc1.c_des_tip_categoria as techo, ".
				  "tc2.i_cod_tip_categoria as idpiso, tc2.c_des_tip_categoria as piso, ".
				  "tc3.i_cod_tip_categoria as idpuerta, tc3.c_des_tip_categoria as puerta, ".
				  "tm.i_cod_tip_material as idmep, tm.c_des_tip_material as material ".
				  "FROM tf_construcciones c ".
				  "inner join tf_ficha f on c.c_id_construccion = f.c_id_construccion ".
				  "inner join tf_pisos p on p.c_cod_pisos = c.c_nume_piso ".
				  "inner join tf_tipo_categoria tc on tc.i_cod_tip_categoria = c.i_estr_muro_col ".   
				  "inner join tf_tipo_categoria tc1 on tc1.i_cod_tip_categoria = c.i_estr_techo ".    
				  "inner join tf_tipo_categoria tc2 on tc2.i_cod_tip_categoria = c.i_acab_piso ".           
				  "inner join tf_tipo_categoria tc3 on tc3.i_cod_tip_categoria = c.i_acab_puerta ".
				  "inner join tf_tipo_material tm on tm.i_cod_tip_material = c.i_mep ".
				  "WHERE c.c_id_uni_cat = '$id' ";
		$consulta_datosConstrucciones= $BD->Consultas($Consulta);
		$construcciones=pg_fetch_array($consulta_datosConstrucciones);
			if(!empty($construcciones))
				return $construcciones;
			else
				echo "hola23";	
	}

	
}