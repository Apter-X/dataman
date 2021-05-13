<?php
/**
* This PHP class allows you to simplify SQL requests (with PDO).
*/
class Database
{
  private $db;
  public $rows;
  public $fetchMode;

  public function __construct($fetchMode = PDO::FETCH_ASSOC)
  {
    try
    {
      $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }
    catch(Exception $event)
    {
      die('Error : ' . $event->getMessage());
    }

    $this->setFetchMode($fetchMode);

    // to prevent against sql injection
    $this->db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
  * Execute an SQL query and return the result (prepared request or not)
  * @param string $request SQL query
  * @param array|null $values Optional values
  * @return PDOStatement
  */
  private function exec($request, $values = null)
  {
      $req = $this->db->prepare($request);
      $this->rows = $req->execute($values);
      return $req;
  }

  /**
  * Define the fetchMode
  * @param int $fetchMode fetchMode
  */
  public function setFetchMode($fetchMode)
  {
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $fetchMode);
  }

  /**
  * Execute an SQL query and return the status
  * @param string $request SQL query
  * @param array|null $values Optional values
  * @return bool Result of the request
  */
  public function execute($request, $values = array())
  {
      $results = self::exec($request, $values);
      return ($results) ? true : false;
  }

  /**
  * Execute an SQL query and return row(s) of the result
  * @param string $request SQL query
  * @param array|null $values Optional values
  * @param bool $all Query with several rows or not
  * @return array|mixed Return data
  */
  public function fetch($request, $values = null, $all = true)
  {
      $results = self::exec($request, $values);
      return ($all) ? $results->fetchAll() : $results->fetch();
  }
}
