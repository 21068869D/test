<?php
require_once 'config.php';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

dbconnect();
function dbconnect() {
  try {
    global $dsn,$username,$password;
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                     PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
}

?>
