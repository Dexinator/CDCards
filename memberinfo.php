<?php

class Member_data{
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo; // PDO object
  private $stmt; // SQL statement
  public $error; // Error message
  
  function __construct() {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }


  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }
  





  function check ($selected_member) {

    // (C2) DATABASE ENTRY
    try {

      $this->stmt = $this->pdo->prepare("SELECT * from membresias where id = ?");
      $this->stmt->execute([$selected_member]);
      return $this->stmt->fetchall(); 
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
}

define("DB_HOST", "localhost");
define("DB_NAME", "cards");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");


$_AVT = new Member_data();


if (isset($_GET["selected_member"])){
  $selected_member=$_GET["selected_member"];
  $rows=$_AVT->check($selected_member);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($rows);
}else {
  echo json_encode("LauraSAD");
}



?>