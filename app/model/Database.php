<?php

// modleフォルダ todo.php

class Database
{

   public function takeTitle() {
      return $this->title;
   }

   public function setTitle($title) {
      $this->title = $title;
   }
   
   public function takeContent() {
      return $this->content;
   }

   public function setContent($content) {
      $this->content = $content;
   }

   public function takeid() {
      return $this->id;
   }

   public function setid($id) {
      $this->id = $id;
   }

   private static  $osaka;
   
   public static function get() {
      try {
         if (!isset(self::$osaka)) {
           self::$osaka = new PDO(
            DSN,USER,PASSWORD,
            [
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
               PDO::ATTR_EMULATE_PREPARES => false,
            ]
            );
         }
         return self::$osaka;
      } catch (PDOException $e) {
         echo $e->getMessage();
         exit;
      }
   }
  
   public static function dbconnect(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM todos');
      if($stmt) {
         $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $lists = array();
      }
      return $lists;
   }

   public static function getAll(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM todos');
      if($stmt) {
         $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $lists = array();
      }
      return $lists;
   }

   public static function findId($todo_id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query(sprintf('SELECT * from todos WHERE id = %s;', $todo_id));
      if($stmt) {
          $todo = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
          $todo = array();
      }
      return $todo;
  }

   public function save() {
      $query = sprintf("INSERT INTO `todos` (`title`, `content`,  `complete`, `created_at`, `updated_at`) VALUES ('%s', '%s',  0, NOW(), NOW())",$this->title,$this->content);

      $pdo = new PDO(DSN, USER, PASSWORD);
      $result = $pdo->query($query);

      return $result;
   }

}