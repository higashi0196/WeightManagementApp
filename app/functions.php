<?php 

require_once('config.php');

function pdo_connect() {
   try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS,[
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
         PDO::ATTR_EMULATE_PREPARES => false,
     ]);
     return $pdo;
   } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
   }
}

function takelists($pdo)
{
  $stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");
  $lists = $stmt->fetchAll();
  return $lists;
}