<?php

require_once '../model/database_fichaAntiguas.php';
class Fichas
{
  private $pdo;

  public $Id_Ficha;
  public $IdUniCat;
  public $Tip_Ficha;
  public $Nro_Ficha;
  public $IdLote;
  public $DC;
  public $Nro_Ficha_Lote;
  public $Activo;
  public $Firma_Declarante;
  public $Declarante;
  public $Fecha_Levantamiento;
  public $Supervisor;
  public $Fecha_Supervision;
  public $Tecnico;
  public $Fecha_Tecnico;
  public $Verificador;
  public $Fecha_Verificacion;
  public $FxRegistro;
  public $IdUsuario;
  public $EstadoReg;
  public $FxActualiza;
  public $IdUsuarioUpd;

  public function __CONSTRUCT()
  {
    try {
      $this->pdo = BaseDatos::StartUp();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function Listar()
  {
    try {
      $result = array();

      $stm = $this->pdo->prepare("SELECT * FROM Ficha");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function ObtenerFichas($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM Ficha WHERE IdLote = ? order by IdUniCat, Nro_Ficha");


      $stm->execute(array($id));
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function ObtenerFicha($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM Ficha WHERE IdLote = ?");

      $stm->execute(array($id));
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
