<?php

// modleフォルダ todo.php
session_start();

require_once('config.php');

class Database
{  
   public $id;
   public $title;
   public $content;
   public $body;
   public $weight;

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
  
   // public static function dbconnect(){
   //    $pdo = new PDO(DSN, USER, PASSWORD);
   //    $stmt = $pdo->query('SELECT * FROM todos;');
   //    $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
   //    return $lists;
   // }

   public static function todogetAll(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query("SELECT * FROM todos");
      $todolists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $todolists;
   }

   public static function wordgetAll(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM words ORDER BY id DESC LIMIT 1;');
      $wordlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $wordlists;
   }

   public static function bodiesgetAll(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT * FROM bodies ORDER BY id DESC LIMIT 1;');
      $bodylists = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $bodylists;
   }

   public static function goalget(){
      $pdo = new PDO(DSN, USER, PASSWORD);
      $stmt = $pdo->query('SELECT goalweights FROM bodies ORDER BY id DESC LIMIT 1;');
      $goallists = $stmt->fetch(PDO::FETCH_ASSOC);
      return $goallists;
   }
   
   public static function findId($id) {
      $pdo = new PDO(DSN, USER, PASSWORD);
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
         // $sql = "INSERT INTO todos (title, content, created_at, updated_at) VALUES (:title, :content, NOW(), NOW())";
         $sql = "INSERT INTO todos (title, content, created_at, updated_at) VALUES ($this->title, '$this->content', NOW(), NOW())";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('title', $title);
         $stmt->bindValue('content', $content);
         $stmt->execute();
      
      } catch(Exception $e) {
         echo $e->getMessage();
         error_log($e->getMessage());
         error_log("新規作成に失敗しました。");
         exit;
      }
   }

   public function postsave() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "INSERT INTO words (content, created_at) VALUES ('$this->content', NOW())";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('content', $content);
         $stmt->execute();

      } catch(Exception $e) {
         echo $e->getMessage();
         exit;
      }
   }

   public function weightsave() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('$this->weight', '$this->body', '$this->today')";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('nowweights', $weight);
         $stmt->bindValue('goalweights', $body);
         $stmt->bindValue('nowdate', $today);
         $stmt->execute();
         
      } catch(Exception $e) {
         echo $e->getMessage();
         exit;
      }
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

      }  catch (PDOException $e) {
         echo $e->getMessage();
         exit;
      }   
   }

   public function delete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "DELETE FROM todos WHERE id = $this->id";

         $stmt = $pdo->prepare($sql);
         $stmt->bindValue('id', $id);
         $stmt->execute();

      }  catch (PDOException $e) {
         echo $e->getMessage();
         exit;
      }   
   }

   public function postdelete() {
      try {
         $pdo = new PDO(DSN, USER, PASSWORD);
         $sql = "TRUNCATE TABLE words";

         $stmt = $pdo->prepare($sql);
         $stmt->execute();

      }  catch (PDOException $e) {
         echo $e->getMessage();
         exit;
      }   
   }
   
}