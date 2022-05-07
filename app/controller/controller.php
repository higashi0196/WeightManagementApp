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

   public function postdelete() {

      $content = (filter_input(INPUT_POST, 'content2'));

      $word = new Database;
      $word->setContent($content);
      $result2 = $word->post();

      header("Location: index.php");
   }

   // public function postdelete() {
   //    $todo_id = $_POST['todo_id'];
   //    if (empty($todo_id)) {
   //       return;
   //       }

   //    $word = new Database;
   //    $word->setId($todo_id);
   //    $result2 = $word->postdelete();

   //    return $result2;
   //    header("Location: ./index.php");
   // }

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
      if (empty($todo_id)) {
         return;
         }

      $todo = new Database;
      $todo->setId($todo_id);
      $result = $todo->delete();

      return $result;
      header("Location: ./index.php");
   }

   public function completestatus() {
      $todo_id = $_POST['todo_id'];
      if (empty($todo_id)) {
         return;
         }

      $todo = Database::findId($todo_id);

      $status = $todo['complete'];
      if($status == Database::status_uncomplete) {
         $status = Database::status_complete;
     } else if($status == Database::status_complete) {
         $status = Database::status_uncomplete;
     }

      $todo = new Database;
      $todo->setId($todo_id);
      $todo->setstatus($todo_status);
      $result = $todo->updatecomplete();
      
      return $result;
      header("Location: ./index.php");
   }

}