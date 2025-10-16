<?php

class DBPostgres
{
  private $connection = null;
  private $config;

  public function __construct()
  {
    $this->config = require __DIR__ . '/_Config.php';
  }

  /**
   * Conectar a la base de datos (solo una vez)
   */
  public function conectar()
  {
    if ($this->connection === null) {
      $this->connection = pg_connect(
        "host={$this->config['host']} " .
        "port={$this->config['puerto']} " .
        "dbname={$this->config['nombre']} " .
        "user={$this->config['usuario']} " .
        "password={$this->config['clave']}"
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

  public function queryParams(string $sql, array $params)
  {
    $conn = $this->conectar();
    $result = pg_query_params($conn, $sql, $params);

    if (!$result) {
      throw new Exception("❌ Error en la consulta con parámetros: " . pg_last_error($conn));
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

  /*
  * Insertar
  */
  public function insert(string $sql, array $params): ?array
  {
    preg_match('/INSERT\s+INTO\s+([a-zA-Z0-9_]+)/i', $sql, $matches);
    $tabla = $matches[1] ?? null;

    $conn = $this->conectar();
    $result = pg_query_params($conn, $sql, $params);

    if (!$result) {
      throw new Exception("❌ Error al insertar: " . $tabla . ": " . pg_last_error($conn));
    }

    $row = pg_fetch_assoc($result);
    return $row ?: null;
  }


  /**
   * Destructor automático
   */
  public function __destruct()
  {
    $this->desconectar();
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
}
