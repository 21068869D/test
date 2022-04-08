<?php
require_once 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

function dbconnect() {
  try {
    global $dsn, $dbuser, $dbpwd;
    $pdo = new PDO($dsn, $dbuser, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
                     PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } catch (PDOException $e) {
    die('Database Error');
  }
}

}
?>
