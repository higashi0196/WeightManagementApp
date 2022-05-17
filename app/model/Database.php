<?php

// modleフォルダ todo.php

// require_once('config.php');

class Database
{
   public $id;
   public $title;
   public $content;
   public $body;
   public $weight;
   public $today;
   public $data = array();
   public $complete;

   const complete_uncomplete = 0;
   const complete_complete = 1;

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

   public function takecomplete() {
      return $this->$complete;
   }

   public function setcomplete($complete) {
      $this->$complete = $complete;
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
         return $result2;
   }

   public function hold() {
      try {
         $query = sprintf("INSERT INTO `bodies` (`bodyweight1`, `bodyweight2`, `nowdate`) VALUES ('%s', '%s', '%s')",$this->body,$this->weight,$this->today);

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

   public function updatecomplete() {
      try {
         $query = sprintf("UPDATE `todos` SET `complete` = '%s', `updated_at` = '%s' WHERE id = %s",$this->status,date("Y-m-d H:i:s"),$this->id);

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

   public function postdelete() {
      try {
         $query = sprintf("DELETE FROM words WHERE id = %s", $this->id);
         $pdo = new PDO(DSN, USER, PASSWORD);
         $result2 = $pdo->query($query);
         header('Location: ' . SITE_URL);
      }  catch (PDOException $e) {
         // エラーログ
         // echo $e->getMessage();
         exit;
      }   
      return $result2;
   }
  
   // public function post() {
   //    try {
   //       $query = sprintf("INSERT INTO `words` (`content`, `created_at`, `updated_at`) VALUES ('', NOW(), NOW())",$this->content);

   //       $pdo = new PDO(DSN, USER, PASSWORD);
   //       $result = $pdo->query($query);
   //    } catch(Exception $e) {
   //       // エラーログ
   //    }
   //       return $result2;
   // }

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

   // ここからした

   const STATUS_INCOMPLETE = 0;
   const STATUS_COMPLETED = 1;

   const STATUS_INCOMPLETE_TXT = "未完了";
   const STATUS_COMPLETED_TXT = "完了";

   public function getStatus() {
      return $this->status;
  }

   public function setStatus($status) {
      $this->status = $status;
  }

   public function updateStatus() {
      error_log("model updateStatus call.");
      try {
          $query = sprintf("UPDATE `todos` SET `status` = '%s', `updated_at` = '%s' WHERE id = %s",
                  $this->status,
                  date("Y-m-d H:i:s"),
                  $this->id
              );

          error_log($query);

          $pdo = new PDO(DSN, USERNAME, PASSWORD);
          $pdo->beginTransaction();

          $result = $pdo->query($query);

          $pdo->commit();

      } catch(Exception $e){
          error_log("ステータス更新に失敗しました。");
          error_log($e->getMessage());
          error_log($e->getTraceAsString());

          $pdo->rollBack();

          return false;
      }
      return $result;
   }

}