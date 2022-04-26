<?php

// modleフォルダ todo.php

// require_once('config.php');

class Database
{

   public $title;
   public $content;
   public $id;
   public $data = array();

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

   public function takeId() {
      return $this->id;
   }

   public function setId($id) {
      $this->id = $id;
   }

   public function takeData() {
      return $this->data;
   }

   public function setData($data) {
      $this->data = $data;
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
      $stmt = $pdo->query('SELECT * FROM todos;');
      if($stmt) {
         $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $lists = array();
      }
      return $lists;
   }

   public static function getAll(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM todos;');
      if($stmt) {
         $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $lists = array();
      }
      return $lists;
   }

   // public static function getAll2(){
   //    $pdo = new PDO(DSN, USER, PASSWORD);
   //    $stmt = $pdo->query('SELECT * FROM words;');
   //    if($stmt) {
   //       $wordlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
   //    } else {
   //       $wordlists = array();
   //    }
   //    return $wordlists;
   // }
   
   public static function findId($todo_id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query(sprintf('SELECT * FROM todos WHERE id = %s;', $todo_id));
      if($stmt) {
          $todo = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
         $todo = array();
      }
      return $todo;
  }
  
   public function save() {
      try {
         $query = sprintf("INSERT INTO `todos` (`title`, `content`,  `complete`, `created_at`, `updated_at`) VALUES ('%s', '%s', 0, NOW(), NOW())",$this->title,$this->content);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $result = $pdo->query($query);
      } catch(Exception $e) {
         // エラーログ
      }
         return $result;
   }

   public function save2() {
      try {
         $query = sprintf("INSERT INTO `words` (`content`, `created_at`, `updated_at`) VALUES ('%s', NOW(), NOW())",$this->content);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $result = $pdo->query($query);
      } catch(Exception $e) {
         // エラーログ
      }
         return $result;
   }

  public function update() {
      try {
         $query = sprintf("UPDATE `todos` SET `title` = '%s', `content` = '%s', `updated_at` = '%s' WHERE id = %s",$this->title,$this->content,date("Y-m-d H:i:s"),$this->id);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $result = $pdo->query($query);
      }  catch (PDOException $e) {
         // エラーログ
      }   
         return $result;
   }

   public function delete() {
      try {
         $query = sprintf("DELETE FROM todos WHERE id = %s", $this->id);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $result = $pdo->query($query);
         header('Location: ' . SITE_URL);
      }  catch (PDOException $e) {
      //    エラーログ
      //    echo $e->getMessage();
      //    exit;
      }   
      return $result;
   }
  
   
  public static function isExistById($todo_id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query(sprintf('select * from todos where id = %s;', $todo_id));
      if($stmt) {
         $todo = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
         $todo = array();
      }

      if($todo) {
         return true;
      }
      return false;
   }

}