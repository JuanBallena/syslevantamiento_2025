<?php

require_once '../model/database_catastro.php';
require_once '../model/constantes.php';

class TipoCategoria
{
  public $IdTipoCategoria;
  public $DesTipoCategoria;

  public function ListarTipoCategoria()
  {
    $BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
    $BD->Conectar();
    $consulta = "SELECT * FROM tf_tipo_categoria";
    $consulta_tipoCategoria = $BD->Consultas($consulta);
    $categorias = pg_fetch_all($consulta_tipoCategoria);
    if (!empty($categorias)) {
      return $categorias;
    } else {
      echo "";
    }

  }



  public function ObtenerTipoCategoriaMuros($id)
  {
    $BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
    $BD->Conectar();
    $Consulta = "SELECT tc.i_cod_tip_categoria, tc.c_des_tip_categoria ".
                  "FROM tf_ficha f ".
                  "INNER JOIN tf_tipo_categoria tc ON f.i_cod_tipo_muros = tc.i_cod_tip_categoria ".
                  "WHERE c_id_uni_cat = '$id' ";
    $consulta_tipoCategoriaMuros = $BD->Consultas($Consulta);
    $categoriaMuros = pg_fetch_array($consulta_tipoCategoriaMuros);
    if (!empty($categoriaMuros)) {
      return $categoriaMuros;
    } else {
      echo "";
    }
  }

  public function ObtenerTipoCategoriaTechos($id)
  {
    $BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
    $BD->Conectar();
    $Consulta = "SELECT tc.i_cod_tip_categoria, tc.c_des_tip_categoria ".
              "FROM tf_ficha f ".
              "INNER JOIN tf_tipo_categoria tc ON f.i_cod_tipo_techos = tc.i_cod_tip_categoria ".
              "WHERE c_id_uni_cat = '$id' ";
    $consulta_tipoCategoriaTechos = $BD->Consultas($Consulta);
    $categoriaTechos = pg_fetch_array($consulta_tipoCategoriaTechos);
    if (!empty($categoriaTechos)) {
      return $categoriaTechos;
    } else {
      echo "";
    }
  }

  public function ObtenerTipoCategoriaPuertas($id)
  {
    $BD = new BaseDeDatos(SERVIDOR, PUERTO, BD, USUARIO, CLAVE);
    $BD->Conectar();
    $Consulta = "SELECT tc.i_cod_tip_categoria, tc.c_des_tip_categoria ".
              "FROM tf_ficha f ".
              "INNER JOIN tf_tipo_categoria tc ON f.i_cod_tipo_puertas = tc.i_cod_tip_categoria ".
              "WHERE c_id_uni_cat = '$id' ";
    $consulta_tipoCategoriaPuertas = $BD->Consultas($Consulta);
    $categoriaPuertas = pg_fetch_array($consulta_tipoCategoriaPuertas);
    if (!empty($categoriaPuertas)) {
      return $categoriaPuertas;
    } else {
      echo "";
    }
  }
}
