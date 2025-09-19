<?php

require_once '../model/database_fichaAntiguas.php';
class LotesFicha
{
  private $pdo;

  public $IdLote;
  public $Id_Lote;
  public $Cod_Uso;
  public $Des_Uso;

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

      $stm = $this->pdo->prepare("SELECT * FROM Lotes");
      $stm->execute();

      return $stm->fetchAll();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function ObtenerLote($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT * FROM Lotes WHERE Id_Lote = ?");


      $stm->execute(array($id));
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function ObtenerLotexUso($id)
  {
    try {
      $stm = $this->pdo
        ->prepare("SELECT Id_Lote as codcata, Cod_Uso,Desc_Uso FROM Lotes l
					  			INNER JOIN Ficha f on f.IdLote = l.IdLote
								INNER JOIN Fichas_Individuales fi on fi.Id_Ficha = f.Id_Ficha
								INNER JOIN Usos u on u.IdUso= fi.IdUso
					  			WHERE Id_Lote = ?");


      $stm->execute(array($id));
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
