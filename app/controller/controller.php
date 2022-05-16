<?php

// controllerフォルダ todocontroller

require_once('config.php');

class Todocontroller {

   public function index() {
      // $lists = Database::dbconnect($query);
      $lists = Database::getAll();
      return $lists;
   }

   public function index2() {
      // $lists = Database::dbconnect($query);
      $wordlists = Database::getAll2();
      return $wordlists;
   }

   public function create() {

      $title = (filter_input(INPUT_POST, 'title'));
      $content = (filter_input(INPUT_POST, 'content'));

      $todo = new Database;
      $todo->setTitle($title);
      $todo->setContent($content);
      $result = $todo->save();

      header("Location: index.php");
   }

   public function create2() {

      $content = (filter_input(INPUT_POST, 'content2'));

      $word = new Database;
      $word->setContent($content);
      $result2 = $word->save2();

      header("Location: index.php");
   }

   public function dietcreate() {

      $body = (filter_input(INPUT_POST, 'body'));
      $weight = (filter_input(INPUT_POST, 'weight'));

      $physical = new Database;
      $physical->setbody($body);
      $physical->setweight($weight);
      $result = $physical->hold();

      header("Location: index.php");
   }

   // public function postdelete() {

   //    $content = (filter_input(INPUT_POST, 'content2'));

   //    $word = new Database;
   //    $word->setContent($content);
   //    $result2 = $word->post();

   //    header("Location: index.php");
   // }

   public function postdelete() {

      $todo_id = $_POST['todo_id'];
      if (empty($todo_id)) {
         return;
         }

      $word = new Database;
      $word->setId($todo_id);
      $result2 = $word->postdelete();

      return $result2;
      header("Location: ./index.php");
   }

   public function edit() {

      $todo_id = '';
      $param = array();

      if($_SERVER['REQUEST_METHOD'] === 'GET') {
         if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
         }
         if(isset($_GET['title'])) {
            $param['title'] = $_GET['title'];
         }
         if(isset($_GET['content'])) {
            $param['content'] = $_GET['content'];
         }
      }

      $todo = Database::findId($todo_id);

      $data = array(
         "todo" => $todo,
         "param" => $param,
     );
      return $data;
   }
   
   public function update() {

      $data = array(
         "todo_id" => $_POST['todo_id'],
         "title" => $_POST['title'],
         "content" => $_POST['content'],
      );
   
      $todo = new Database;
      $datasetting = new Database;

      $datasetting->setData($data);
      $dataset = $datasetting->takeData();
      $todo->setId($dataset['todo_id']);
      $todo->setTitle($dataset['title']);
      $todo->setContent($dataset['content']);

      $result = $todo->update();
      header("Location: ./index.php");
   }

   public function delete() {

      $todo_id = $_POST['todo_id'];

      $todo = new Database;
      $todo->setId($todo_id);
      $result = $todo->delete();

      return $result;
      // header("Location: ./index.php");
   }

   public function completestatus() {

      $todo_id = $_POST['todo_id'];
      $todo = Database::findId($todo_id);

      $complete = $todo['complete'];
      if($complete === Database::complete_uncomplete) {
         $complete = Database::complete_uncomplete;
     } else if($complete === Database::complete_complete) {
         $complete = Database::complete_uncomplete;
     }

      $todo = new Database;
      $todo->setId($todo_id);
      $todo->setcomplete($complete);
      $result = $todo->updatecomplete();

      return $result;
      header("Location: ./index.php");
   }

      // ここからした
   public function updateStatus() {
      error_log("updateStatus call.");
      $todo_id = $_POST['todo_id'];
      if(!$todo_id) {
          error_log(sprintf("[TodoController][updateStatus]todo_id id not found. todo_id: %s", $todo_id));
          return false;
      }

      // if(Database::isExistId($todo_id) === false) {
      //     error_log(sprintf("[TodoController][updateStatus]record is not found. todo_id: %s", $todo_id));
      //     return false;
      // }

      // $todo = Database::findId($todo_id);
      // if(!$todo) {
      //     error_log(sprintf("[TodoController][updateStatus]record is not found. todo_id: %s", $todo_id));
      //     return false;
      // }

      $status = $todo['status'];
      if($status == Database::STATUS_INCOMPLETE) {
          $status = Database::STATUS_COMPLETED;
      } else if($status == Database::STATUS_COMPLETED) {
          $status = Database::STATUS_INCOMPLETE;
      }

      $todo = new Todo;
      $todo->setId($todo_id);
      $todo->setStatus($status);
      $result = $todo->updateStatus();

      error_log(print_r($result, true));

      return $result;
  }

}