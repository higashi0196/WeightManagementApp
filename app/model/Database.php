<?php

// modleフォルダ todo.php

require_once('config.php');

class Database
{
   public $id;
   public $title;
   public $content;
   public $body;
   public $weight;
   public $data = array();

   public function takeId() {
      return $this->id;
   }

   public function setId($id) {
      $this->id = $id;
   }
   
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

   public function takebody() {
      return $this->body;
   }

   public function setbody($body) {
      $this->body = $body;
   }

   public function takeweight() {
      return $this->weight;
   }

   public function setweight($weight) {
      $this->weight = $weight;
   }

   public function taketoday() {
      return $this->today;
   }

   public function settoday($today) {
      $this->today = $today;
   }

   public function takeData() {
      return $this->data;
   }

   public function setData($data) {
      $this->data = $data;
   }

   public function takeweightData() {
      return $this->weightdata;
   }

   public function setweightData($weightdata) {
      $this->weightdata = $weightdata;
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
      $stmt = $pdo->query("SELECT * FROM todos");
      if($stmt) {
         $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $lists = array();
      }
      return $lists;
   }

   public static function getAll2(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM words ORDER BY id DESC LIMIT 1;');
      if($stmt) {
         $wordlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $wordlists = array();
      }
      return $wordlists;
   }

   public static function getAll3(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM bodies ORDER BY id DESC LIMIT 1;');
      if($stmt) {
         $bodylists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
         $bodylists = array();
      }
      return $bodylists;
   }

   public static function getAll4(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT goalweights FROM bodies ORDER BY id DESC LIMIT 1;');
      if($stmt) {
         $goallists = $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
         $goallists = array();
      }
      return $goallists;
   }
   
   public static function findId($id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query(sprintf('SELECT * FROM todos WHERE id = %s;', $id));
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

   public function postsave() {
      try {
         $query = sprintf("INSERT INTO `words` (`content`, `created_at`) VALUES ('%s', NOW())",$this->content);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $postresult = $pdo->query($query);
      } catch(Exception $e) {
         // エラーログ
      }
         return $postresult;
   }

   public function weightsave() {
      try {
         $query = sprintf("INSERT INTO bodies (nowweights,goalweights, nowdate) VALUES ('%s', '%s', '%s')",$this->weight,$this->body,$this->today);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $weightresult = $pdo->query($query);
      } catch(Exception $e) {
         // エラーログ
      }
         return $weightresult;
   }

   public function update() {
      try {
         $query = sprintf("UPDATE `todos` SET `title` = '%s', `content` = '%s', updated_at = NOW() WHERE id = %s",$this->title,$this->content,$this->id);

         $pdo = new PDO(DSN, USER, PASSWORD);
         $result = $pdo->query($query);
      }  catch (PDOException $e) {
         // エラーログ
      }   
         return $result;
   }
   // $query = sprintf("DELETE FROM todos WHERE id = %s", $this->id);
   // ORDER BY id DESC LIMIT 1
   public function delete() {
      try {
         $query = sprintf("DELETE FROM todos ORDER BY id DESC LIMIT 1", $this->id);
         $pdo = new PDO(DSN, USER, PASSWORD);
         $result = $pdo->query($query);

      }  catch (PDOException $e) {
      //    エラーログ
         // echo $e->getMessage();
         // exit;
      }   
      return $result;
   }

   public function postdelete() {
      try {
         $query = sprintf("TRUNCATE TABLE words");
         $pdo = new PDO(DSN, USER, PASSWORD);
         $postdelete = $pdo->query($query);
      }  catch (PDOException $e) {
         // エラーログ
         // echo $e->getMessage();
         exit;
      }   
      return $postdelete;
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