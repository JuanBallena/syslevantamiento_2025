<?php

class DBPostgres
{
  private const SERVIDOR = "localhost";
  private const PUERTO = 5432;
  private const NOMBRE = "dbfichas";
  private const USUARIO = "postgres";
  private const CLAVE = "";

  private $connection = null;

  /**
   * Conectar a la base de datos (solo una vez)
   */
  public function conectar()
  {
    if ($this->connection === null) {
      $this->connection = pg_connect(
        "host=" . self::SERVIDOR .
          " port=" . self::PUERTO .
          " dbname=" . self::NOMBRE .
          " user=" . self::USUARIO .
          " password=" . self::CLAVE
      );

      if (!$this->connection) {
        throw new Exception("❌ Error de conexión a la base de datos PostgreSQL");
      }
    }
    return $this->connection;
  }

  /**
   * Ejecuta una consulta
   */
  public function query(string $sql)
  {
    $conn = $this->conectar();
    $result = pg_query($conn, $sql);

    if (!$result) {
      throw new Exception("❌ Error en la consulta: " . pg_last_error($conn));
    }

    return $result;
  }

  /**
   * Devuelve todos los registros
   */
  public function fetchAll(string $sql): array
  {
    $result = $this->query($sql);
    return pg_fetch_all($result) ?: [];
  }

  /**
   * Devuelve un solo registro
   */
  public function fetchOne(string $sql): ?array
  {
    $result = $this->query($sql);
    return pg_fetch_assoc($result) ?: null;
  }

  /**
   * Cierra conexión
   */
  public function desconectar(): void
  {
    if ($this->connection !== null) {
      pg_close($this->connection);
      $this->connection = null;
    }
  }

  /**
   * Destructor automático
   */
  public function __destruct()
  {
    $this->desconectar();
  }
}
