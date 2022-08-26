<?php

session_start();

require_once('./../../config/config.php');

class Database
{  
   public $id;
   public $title;
   public $content;
   public $body;
   public $weight;
   public $today;

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

   public function getBody() {
      return $this->body;
   }

   public function setBody($body) {
      $this->body = $body;
   }

   public function getWeight() {
      return $this->weight;
   }

   public function setWeight($weight) {
      $this->weight = $weight;
   }

   public function getToday() {
      return $this->today;
   }

   public function setToday($today) {
      $this->today = $today;
   }

   public function getComment() {
      return $this->comment;
   }

   public function setComment($comment) {
      $this->comment = $comment;
   }
  
   // [
   //    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
   //    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
   //    PDO::ATTR_EMULATE_PREPARES => false,
   // ]
  
   public static function findId($id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $sql = "SELECT * FROM todos WHERE id = :id";

      $stmt = $pdo->prepare($sql);
      $stmt->bindValue('id', $id);
      $stmt->execute();
      $todo = $stmt->fetch(PDO::FETCH_ASSOC);
      return $todo;
  }

   public static function todogetAll() {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $stmt = $pdo->query("SELECT * FROM todos");
      $todolists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $todolists;
   }

   public static function toggle($id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $sql = "UPDATE todos SET is_done = NOT is_done , updated_at = NOW() WHERE  id = :id";
      
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue('id', $id, \PDO::PARAM_INT);
      $stmt->execute();
  }

   public function save() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "INSERT INTO todos (title, content, created_at, updated_at) VALUES ('$this->title', '$this->content', NOW(), NOW())";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('title', $title);
         $stmt->bindValue('content', $content);
         $stmt->execute();

         $pdo->commit();

      } catch (Exception $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }
   }

   public function update() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "UPDATE todos SET title = '$this->title', content = '$this->content', updated_at = NOW() WHERE id = '$this->id'";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('title', $title);
         $stmt->bindValue('content', $content);
         $stmt->bindValue('id', $id);
         $stmt->execute();

         $pdo->commit();

      } catch (PDOException $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }   
   }

   public function tododelete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "DELETE FROM todos WHERE id = $this->id";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('id', $id);
         $stmt->execute();

         $pdo->commit();

      } catch (PDOException $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }   
   }

   public static function postgetAll() {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $stmt = $pdo->query('SELECT * FROM words ORDER BY id DESC LIMIT 1');
      $wordlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $wordlists;
   }

   public function postsave() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "INSERT INTO words (content, created_at) VALUES ('$this->content', NOW())";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('content', $content);
         $stmt->execute();

         $pdo->commit();

      } catch (Exception $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }
   }

   public function postdelete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "TRUNCATE TABLE words";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->execute();

         $pdo->commit();

      } catch (PDOException $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }   
   }

   public static function weightsgetAll() {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $stmt = $pdo->query('SELECT * FROM bodies ORDER BY id DESC LIMIT 1');
      $bodylists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $bodylists;
   }

   public static function goalget() {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $stmt = $pdo->query('SELECT goalweights FROM bodies ORDER BY id DESC LIMIT 1');
      $goallists = $stmt->fetch(PDO::FETCH_ASSOC);
      return $goallists;
   }

   public function weightsave() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('$this->weight', '$this->body', '$this->today')";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('nowweights', $weight);
         $stmt->bindValue('goalweights', $body);
         $stmt->bindValue('nowdate', $today);
         $stmt->execute();

         $pdo->commit();
         
      } catch (Exception $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }
   }

   public function fileAllget() {
      $pdo = new PDO(DSN, USER, PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      // $stmt = $pdo->query("SELECT * FROM p");
      $stmt = $pdo->query("SELECT * FROM pictures");
      $filelists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $filelists;
   }

   // public function filesave2($file_type,$comment) {
      
   //       $pdo = new PDO(DSN, USER, PASSWORD);
   //       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //       $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   //       $image = base64_encode($_FILES['img']['tmp_name']);

   //       $sql = "INSERT INTO p (img, filetype, comment, created_at) VALUES (?, ?, ?, NOW())";
   //       $stmt = $pdo->prepare($sql);
   //       $stmt->bindValue(1, $image);
   //       $stmt->bindValue(2, $file_type);
   //       $stmt->bindValue(3, $comment);
   //       $stmt->execute();
   // }

   public function filesave($filename,$save_path,$comment) {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $image = base64_encode($_FILES['img']['tmp_name']);

         $sql = "INSERT INTO pictures (file_name, file_path, tmp_name, comment,created_at) VALUES (?, ?, ?, ?, NOW())";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);

         $stmt->bindValue(1, $filename);
         $stmt->bindValue(2, $save_path);
         $stmt->bindValue(3, $image);
         $stmt->bindValue(4, $comment);
         $stmt->execute();

         $pdo->commit();

      } catch (PDOException $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }   
   }

   public function filedelete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
         $sql = "DELETE FROM pictures WHERE id = $this->id";

         $pdo->beginTransaction();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('id', $id);
         $stmt->execute();

         $pdo->commit();

      } catch (PDOException $e) {
         error_log($e->getMessage());
         header('Location: ./../../view/error/404.php');

         $pdo->rollBack();
         exit;
      }   
   }
   
}