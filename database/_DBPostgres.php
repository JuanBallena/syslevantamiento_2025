<?php

require_once __DIR__ . '/_CreateResponse.php';

class DBPostgres
{
  private static $instance = null;
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

    // return $this->connection;// eliminar luego
  }

  public static function getInstance(array $config): DBPostgres
  {
    if (self::$instance === null) {
      self::$instance = new self($config);
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }

  /**
   * Ejecuta una consulta
   */
  public function query(string $sql)
  {
    // $conn = $this->conectar();
    $result = pg_query($this->connection, $sql);

    if (!$result) {
      throw new Exception("❌ Error en la consulta: " . pg_last_error($this->connection));
    }

    return $result;
  }

  public function queryParams(string $sql, array $params)
  {
    // $conn = $this->conectar();
    $result = pg_query_params($this->connection, $sql, $params);

    if (!$result) {
      throw new Exception("❌ Error en la consulta con parámetros: " . pg_last_error($this->connection));
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

    $result = pg_query_params($this->connection, $sql, $params);

    if (!$result) {
      $errorMessage = pg_last_error($this->connection);

      if (strpos($errorMessage, 'llave duplicada') !== false) {
        createResponse(false, [], $this->obtenerMensajePorTabla($tabla));
      }

      throw new Exception("❌ Error al insertar en $tabla: " . $errorMessage);
    }

    $row = pg_fetch_assoc($result);

    // Convertir todos los valores retornados a string para evitar perder ceros a la izquierda
    if ($row !== false && is_array($row)) {
      $row = array_map(function ($value) {
        return is_null($value) ? null : (string) $value;
      }, $row);
    }

    return $row ?: null;
  }


  public function beginTransaction()
  {
    pg_query($this->connection, "BEGIN");
  }

  public function commit()
  {
    pg_query($this->connection, "COMMIT");
  }

  public function rollback()
  {
    pg_query($this->connection, "ROLLBACK");
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

  public function obtenerMensajePorTabla(string $nombreTabla): string
  {
    $mensajes = [
      'tf_lotes' => 'El lote que intenta registrar ya existe.',
      'tf_edificaciones' => 'La edificación ya ha sido registrada previamente.',
      'usuarios' => 'Ya existe un usuario con estos datos.',
    ];

    return $mensajes[$nombreTabla] ?? "Ocurrió un error al procesar el registro en la tabla '$nombreTabla'.";
  }
}
