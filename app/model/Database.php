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

   public function getId() {
      return $this->id;
   }

   public function setId($id) {
      $this->id = $id;
   }
   
   public function getTitle() {
      return $this->title;
   }

   public function setTitle($title) {
      $this->title = $title;
   }
   
   public function getContent() {
      return $this->content;
   }

   public function setContent($content) {
      $this->content = $content;
   }

   public function getbody() {
      return $this->body;
   }

   public function setbody($body) {
      $this->body = $body;
   }

   public function getweight() {
      return $this->weight;
   }

   public function setweight($weight) {
      $this->weight = $weight;
   }

   public function gettoday() {
      return $this->today;
   }

   public function settoday($today) {
      $this->today = $today;
   }

   public function getData() {
      return $this->data;
   }

   public function setData($data) {
      $this->data = $data;
   }

   public function getweightData() {
      return $this->weightdata;
   }

   public function setweightData($weightdata) {
      $this->weightdata = $weightdata;
   }

   private static $osaka;
   
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
      $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $lists;
   }

   public static function getAll(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query("SELECT * FROM todos");
      $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $lists;
   }

   public static function getAll2(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM words ORDER BY id DESC LIMIT 1;');
      $wordlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $wordlists;
   }

   public static function getAll3(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM bodies ORDER BY id DESC LIMIT 1;');
      $bodylists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $bodylists;
   }

   public static function getAll4(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT goalweights FROM bodies ORDER BY id DESC LIMIT 1;');
      $goallists = $stmt->fetch(PDO::FETCH_ASSOC);
      return $goallists;
   }
   
   public static function findId($id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      // $stmt = $pdo->query(sprintf('SELECT * FROM todos WHERE id = %s;', $id));
      $sql = "SELECT * FROM todos WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue('id', $id);
      $stmt->execute();
      $todo = $stmt->fetch(PDO::FETCH_ASSOC);
      return $todo;
  }

   public function save() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "INSERT INTO todos (title, content, created_at, updated_at) VALUES ('$this->title', '$this->content', NOW(), NOW())";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('title', $title);
         $stmt->bindValue('content', $content);
         $stmt->execute();
         $result = $stmt->fetchAll();
      
      } catch(Exception $e) {
         error_log($e->getMessage());
         error_log("新規作成に失敗しました。");
      }
         return $result;
   }

   public function postsave() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "INSERT INTO words (content, created_at) VALUES ('$this->content', NOW())";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('content', $content);
         $stmt->execute();
         $postresult = $stmt->fetchAll();

      } catch(Exception $e) {
         // エラーログ
      }
         return $postresult;
   }

   public function weightsave() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('$this->weight', '$this->body', '$this->today')";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('nowweights', $nowweights);
         $stmt->bindValue('goalweights', $goalweights);
         $stmt->bindValue('nowdate', $nowdate);
         $stmt->execute();
         
         $weightresult = $stmt->fetchAll();
      } catch(Exception $e) {
         // エラーログ
      }
         return $weightresult;
   }

   public function update() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "UPDATE todos SET title = '$this->title', content = '$this->content', updated_at = NOW() WHERE id = '$this->id'";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('title', $title);
         $stmt->bindValue('content', $content);
         $stmt->bindValue('id', $id);
         $stmt->execute();
         $result = $stmt->fetchAll();

      }  catch (PDOException $e) {
         // エラーログ
      }   
         return $result;
   }

   public function delete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "DELETE FROM todos WHERE id = $this->id";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('id', $id);
         $stmt->execute();
         $result = $stmt->fetch();

      }  catch (PDOException $e) {
      //    エラーログ
         // echo $e->getMessage();
         // exit;
      }   
      return $result;
   }

   public function postdelete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "TRUNCATE TABLE words";
         $stmt = $pdo->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetch();
      }  catch (PDOException $e) {
         // エラーログ
         // echo $e->getMessage();
         exit;
      }   
      return $postdelete;
   }

   public static function isExistById($id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query(sprintf('select * from todos where id = %s;', $id));
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
   // public static function isExistById($todo_id) {
   //    $pdo = new PDO(DSN, USER, PASSWORD);
   //    $stmt = $pdo->query(sprintf('select * from todos where id = %s;', $todo_id));
   //    if($stmt) {
   //       $todo = $stmt->fetch(PDO::FETCH_ASSOC);
   //    } else {
   //       $todo = array();
   //    }

   //    if($todo) {
   //       return true;
   //    }
   //    return false;
   // }
   
}