<?php
/*
* @author Unittá Comunicação & Estratégia
* @version 2.0 <02/2018>
*       ,
*      ((_,-.
*        '-.\_)'-,
*          )  _ )'-
* ,.;.,;,,(/(/ \));,;.,.,
*
* Simplifica o acesso ao banco de dados utilizando
*
*/
error_reporting(E_ALL);

Class Influx {

  public $config = array(
    'host' => "localhost",
    'port' => 3306,
    'dbname' => 'unitt',
    'user' => 'root',
    'password' => '12345'
  );
  public $fetchAll;
  public $result;
  public $driver;
  public $host;
  public $port;
  public $user;
  public $pass;
  public $con;
  public $dbname = null;
  public $data = null;
  public $tabela = null;
  public $campo = "";
  public $query = null;
  public $valor = null;
  public $post_fields = array();
  public $post_values = array();
  public $strupdate = null;
  public $strorderby = null;
  public $limit = "";
  public $offset = "";
  public $response;
  public $limitOffset = null;

  public function __construct() {
    try {
      # Recupera os dados de conexao do config
      $this->dbname = $this->config['dbname'];
      $this->host = $this->config['host'];
      $this->port = $this->config['port'];
      $this->user = $this->config['user'];
      $this->pass = $this->config['password'];
      # instancia e retorna objeto
      $this->con = @mysql_connect("$this->host", "$this->user", "$this->pass");
      @mysql_select_db("$this->dbname");
      if (!$this->con) {
        throw new Exception("Falha na conexão MySql com o banco [$this->dbname] em database.conf.php");
      } else {
        return $this->con;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  *  Mtodo utilizado para realizar a selao
  *  Se o argumento for omitido o campo assumido ser "*"
  *  @name database
  *  @param String
  *  @example $obj->select();
  *  @example $obj->select('*');
  *  @example $obj->select('user_id','user_name');
  *  @example $obj->select('user_id as id','user_name as name');
  */
  public function select($campo = null) {
    if ($campo != null) {
      $this->campo = $campo;
    } else {
      $this->campo = "*";
    }
    $this->method = "SELECT";
    $this->data = null;
    $this->query = "SELECT $this->campo FROM ";
    return $this;
  }

  /**
  * Utilizado aps o mtodo select para realizar join's
  *
  * @name join
  * @param String $table Nome da tabela
  * @param String $condition Condio do JOIN
  * @param String $method  INNER, LEFT...
  * @example $obj->join("t1","t1.id = t2.id","INNER");
  */
  public function join($table = '', $condition = '', $method = '') {
    try {
      if ($table == '' || $condition == '') {
        throw new Exception("join: tabela e condicao devem ser informados como parametros do metodo.");
      } else {
        if ($method != '') {
          $this->query .= " $method JOIN $table ON ($condition) ";
        } else {
          $this->query .= " JOIN $table ON ($condition) ";
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado aps o mtodo select, aponta a tabela destino
  *
  * @name from
  * @param String $table Nome da tabela
  * @example $obj->from("table");
  */
  public function from($table = null) {
    try {
      if ($table == null) {
        throw new Exception("from - A(s) tabela(s) deve(m) ser informada(s) no metodo.");
      } else {
        $this->tabela = $table;
        $this->query .= " $this->tabela ";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado para sql insert
  *
  * @name insert
  * @param String $table Nome da tabela
  * @example $obj->insert("produtos");
  */
  public function insert($table = null) {
    try {
      if ($table == null) {
        throw new Exception("insert: Uma tabela deve ser informada como parametro do metodo.");
      } else {
        $this->tabela = $table;
        $this->campo = null;
        $this->valor = null;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado em insert para informar os campos de destino
  *
  * @name fields
  * @param Array $field Nome do campo
  * @example $obj->fields(array('campo1','campo2'));
  */
  public function fields($fields = array()) {
    try {
      if (empty($fields)) {
        throw new Exception("fields: O(s) campo(s) destino da insero deve(m) ser informado(s) no mtodo.");
      } else {
        $this->campo = implode(",", $fields);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado no insert para informar os valores dos campos
  *
  * @name values
  * @param Array $value Valor do campo
  * @example $obj->values(array(10,'foo'));
  */
  public function values($values = array()) {
    try {
      if (empty($values)) {
        throw new Exception("values: O(s) valor(es) deve(m) ser informado(s) como parmetro(s) do mtodo.");
      } else {
        $this->valor = "'" . implode("','", $values) . "'";
        $this->query = "INSERT INTO $this->tabela ($this->campo) VALUES ($this->valor);";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado para Update no banco
  *
  * @name update
  * @param String $table Nome da tabela
  * @example $obj->update('users');
  */
  public function update($table = null) {
    try {
      if ($table == null) {
        throw new Exception("update: A tabela destino deve ser informada como parmetro do mtodo.");
      } else {
        $this->strupdate = "";
        $this->tabela = $table;
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado aps update, define nome e valor do campo
  *
  * @name set
  * @param Array $field Nome do campo
  * @param Array $value Valor do campo
  * @example $obj->set(array("nome","idade"),array("Blair",28));
  */
  public function set($fields = array(), $values = array()) {
    try {
      if (!empty($fields) && !empty($values)) {
        $params = (array_combine($fields, $values));
        foreach ($params as $key => $value) {
          $this->strupdate .= " $key = '$value',";
        }
        $this->query = "UPDATE $this->tabela SET " . substr($this->strupdate, 0, -1);
      } else {
        throw new Exception("set: Arrays fields ou values vazios.");
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Utilizado para deletar registros de uma tabela
  *
  * @name delete
  * @example $obj->delete();
  */
  public function delete() {
    $this->query = "DELETE FROM ";
    return $this;
  }

  /**
  * Utilizado para retornar campos de uma tabela
  *
  * @name delete
  * @example $obj->delete();
  */
  public function showcol() {
    $this->query = "SHOW COLUMNS FROM ";
    return $this;
  }

  /**
  *
  * Utilizado para realizar seleo com a condio
  * @name where
  * @param String $condition
  * @example $obj->where("id = 1");
  * @example $obj->where("username = 'foo' ");
  */
  public function where($condition = null) {
    try {
      if ($condition == null) {
        throw new Exception("where: A condio deve ser informada como parmetro do mtodo.");
      } else {
        $this->query .= " WHERE $condition";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Metodo Sql orderby
  *
  * @name orderby
  * @param Strin $order campo ordem
  * @example $obj->orderby("nome asc");
  * @example $obj->orderby("nome desc");
  */
  public function orderby($order = null) {
    try {
      if ($order == null) {
        throw new Exception("orderby: O campo e ordem devem ser informadas como parmetros do mtodo.");
      } else {
        $this->query .= " order by $order";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Metodo sql groupby
  *
  * @name orderby
  * @param Strin $order campo ordem
  * @example $obj->orderby("nome asc");
  * @example $obj->orderby("nome desc");
  */
  public function groupby($field = null) {
    try {
      if ($field == null) {
        throw new Exception("groupby: O campo deve ser informado como parmetro do mtodo.");
      } else {
        $this->query .= " GROUP BY $field";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  *  check - Verifica se h dados retornados da query
  *  @return bool
  *  @example $obj->check()
  */
  public function check() {
    if (isset($this->data)) {
      if (count($this->data) && !empty($this->data[0])) {
        return true;
      } else {
        return false;
      }
    }
  }

  /**
  * Utilizado para mudar o encoding utf8_decode, utf8_encode, htmlentities ...
  * @name encode
  * @param String $encoding
  * @example $obj->encode('key','utf8_decode');
  * @example $obj->encode();
  * defauls all keys to utf8_decode
  */
  public function encode($tbkey = null, $encoding = 'utf8_decode') {
    try {
      if (!empty($this->data)) {
        foreach ($this->data as $idx => $val) {
          if (isset($this->data[$idx]["$tbkey"])) {
            $this->data[$idx]["$tbkey"] = $encoding($this->data[$idx]["$tbkey"]);
          }
        }
      } else {
        //throw  new Exception("encode: O array de origem est vazio.");
        $this->response = "encode: O array de origem est vazio.";
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  /**
  * Redireciona URL
  * redirect
  * @param String $url
  */
  public function redirect($url = null) {
    @header("Location: $url");
  }

  /**
  * Executa Query direto (Utilizada para efetuar sub-querys)
  * sub-querys
  * @param String $queryFrom
  */
  public function execQuery($queryFrom = null) {
    try {
      if ($queryFrom == '') {
        throw new Exception('mysql query: A query deve ser informada como parmetro do mtodo.');
      } else {
        $this->result = mysql_query($queryFrom);
        if ($this->result) {
          $this->data = $this->fetchAll();
        } else {
          $this->response = "sem resultados para a query: $this->query;";
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  public function execute() {
    try {
      if ($this->query == '') {
        throw new Exception('mysql query: A query deve ser informada como parmetro do mtodo.');
      } else {
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');
        $this->result = mysql_query($this->query);


        if ($this->result) {

          $this->data = $this->fetchAll();
        } else {
          $this->response = "sem resultados para a query: $this->query;";
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  /*
  * Retorna oarray pre formatado
  * printr
  * @param Array $array
  * @example $obj->printr($data);
  */

  public function printr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  }

  /**
  * Popula os arrays fields e values para montar a query
  * post2Query
  * retorna os dados em $this->post_fields e $this->post_values
  * @param Array $arr2query
  * @example $obj->post2Query($_POST);
  * @example $obj->post2Query($_GET);
  */
  public function post2Query($arr2query) {
    try {
      if (!is_array($arr2query) || empty($arr2query)) {
        throw new Exception('post2query: O paramtro no  um array ou est vazio!');
      } else {
        foreach ($arr2query as $key => $value) {
          $this->post_fields[] = trim("$key");
          $this->post_values[] = trim("$value");
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  public function fetchAll() {
    $this->fetchAll = "";
    while ($row = @mysql_fetch_array($this->result, MYSQL_ASSOC)) {
      $this->fetchAll[] = $row;
    }
    return $this->fetchAll;
  }

  public function rowCount() {
    return @mysql_affected_rows();
  }

  public function limit($limit, $offset) {
    $this->query .= " LIMIT " . (int) $limit . "," . (int) $offset;
    return $this;
  }

  public function arrayInsert($table, Array $data) {

    try {
      foreach ($data as $x => $y) {
        if (is_null($y) && $y == 0 && $y == ""):
          $values[] = "{$x} = NULL";
        else:
          $values[] = "{$x} = '{$y}'";
        endif;
      }
      $final = implode(", ", $values);
      $this->query = " INSERT INTO {$table} SET {$final}";
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  public function arrayUpdate($table, Array $data, $where) {

    try {

      foreach ($data as $x => $y) {
        if (is_null($y) && $y == 0 && $y == ""):
          $values[] = "{$x} = NULL";
        else:
          $values[] = "{$x} = '{$y}'";
        endif;
      }
      $final = implode(", ", $values);
      $this->query = " UPDATE {$table} SET {$final} WHERE {$where} ";
    } catch (Exception $e) {
      echo $e->getMessage();
      exit;
    }
    return $this;
  }

  public function lastInsertID() {

    return mysql_insert_id();
  }

}

/* end file */
